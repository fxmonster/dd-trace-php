<?php

namespace DDTrace\Bridge;

/**
 * Tells whether or not tracing is enabled without having to fire the auto-loading mechanism.
 *
 * @return bool
 */
function dd_tracing_enabled()
{
    $value = getenv('DD_TRACE_ENABLED');
    if (false === $value) {
        // Not setting the env means we default to enabled.
        return true;
    }

    $value = trim(strtolower($value));
    if ($value === '0' || $value === 'false') {
        return false;
    } else {
        return true;
    }
}

/**
 * Checks if any of the provided classes exists.
 *
 * @param string[] $sentinelClasses
 * @return bool
 */
function any_class_exists(array $sentinelClasses)
{
    foreach ($sentinelClasses as $sentinelClass) {
        if (class_exists($sentinelClass)) {
            return true;
        }
    }

    return false;
}

/**
 * Extracts an array ['My\Autoloader\Class', 'method'] if the loader class and methods are in a known format, otherwise
 * it returns null.
 *
 * @param \callable $loader As in http://php.net/manual/en/language.types.callable.php
 * @return array|null
 */
function extract_autoloader_class_and_method($loader)
{
    // Covers case: spl_autoloader_register('Some\Class::load')
    if (is_string($loader)) {
        $parts = explode('::', $loader);
        return count($parts) === 2 ? [$parts[0], $parts[1]] : null;
    }
    // Covers case: spl_autoloader_register(['Some\Class', 'load'])
    if (is_array($loader) && count($loader) === 2) {
        if (is_string($loader[0])) {
            return [$loader[0], $loader[1]];
        } elseif (is_object($loader[0])) {
            return [get_class($loader[0]), $loader[1]];
        } else {
            return null;
        }
    }
    // Case not covered: spl_autoloader_register(null);
    // Case not covered: spl_autoloader_register(function () {});
    return null;
}

/**
 * Registers the Datadog.
 */
function dd_register_autoloader()
{
    require_once __DIR__ . '/dd_autoloader.php';
    spl_autoload_register(['\DDTrace\Bridge\Autoloader', 'load'], true, true);
}

/**
 * Unregisters the Datadog.
 */
function dd_unregister_autoloader()
{
    spl_autoload_unregister(['\DDTrace\Bridge\Autoloader', 'load']);
}

/**
 * Traces spl_autoload_register in order to provide hooks for auto-instrumentation to be executed.
 */
function dd_wrap_autoloader()
{
    dd_register_autoloader();

    // Composer auto-generates a class loader with a varying name which follows the pattern
    // `ComposerAutoloaderInitaa9e6eaaeccc2dd24059c64bd3ff094c`. The name of this class varies and this variable is
    // used to keep track of the actual name.
    $composerAutogeneratedClass = null;

    dd_trace('spl_autoload_register', function () use (&$composerAutogeneratedClass) {

        $args = func_get_args();
        $originalAutoloaderRegistered = call_user_func_array('spl_autoload_register', $args);
        $loader = $args[0];
        $extractedClassAndMethod = extract_autoloader_class_and_method($loader);
        if (empty($extractedClassAndMethod)) {
            return $originalAutoloaderRegistered;
        }
        list ($loaderClass) = $extractedClassAndMethod;

        // If we detect the composer autogenerated autoloader, there is nothing we have to do at this time.
        // We wait for the next class, which is the actual composer autoloader, to check if the user
        // declared datadog/dd-trace in its own composer.json. If so, then we use this instead of the one
        // provided with the extension.
        $generatedComposerClassPrefix = 'ComposerAutoloaderInit';
        if (substr($loaderClass, 0, strlen($generatedComposerClassPrefix)) === $generatedComposerClassPrefix) {
            $composerAutogeneratedClass = $loaderClass;
            return $originalAutoloaderRegistered;
        }

        if ($loaderClass === 'Composer\Autoload\ClassLoader') {
            // If users declared a dependency on `datadog/dd-trace`, we want to honor that!
            if (method_exists('Composer\Autoload\ClassLoader', 'loadClass')
                    && null !== $composerAutogeneratedClass
                    && method_exists($composerAutogeneratedClass, 'getLoader')
            ) {
                $actualComposerLoader = call_user_func([$composerAutogeneratedClass, 'getLoader']);
                if (true === $actualComposerLoader->loadClass('\DDTrace\Tracer')) {
                    dd_unregister_autoloader();
                }
            }
        }

        dd_untrace('spl_autoload_register');
        require __DIR__ . '/dd_init.php';
    });
}
