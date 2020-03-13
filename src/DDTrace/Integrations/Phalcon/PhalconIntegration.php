<?php

namespace DDTrace\Integrations\Phalcon;

use DDTrace\Integrations\Integration;
use DDTrace\Tag;
use DDTrace\Type;
use DDTrace\GlobalTracer;


class PhalconIntegration extends Integration
{
    const NAME = 'phalcon';

    /**
     * @var self
     */
    private static $instance;

    /**
     * @return self
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return string The integration name.
     */
    public function getName()
    {
        return self::NAME;
    }


    /**
     * Static method to add instrumentation to the Redis library
     */
    public static function load()
    {
        if (!extension_loaded('phalcon')) {
            return Integration::NOT_AVAILABLE;
        }

        dd_trace('Phalcon\Mvc\Model', 'find', function () {
            $tracer = GlobalTracer::get();
            if ($tracer->limited()) {
                return dd_trace_forward_call();
            }

            $scope = $tracer->startIntegrationScopeAndSpan(
                PhalconIntegration::getInstance(),
                'Model.find'
            );

            $span = $scope->getSpan();
            $span->setTag(Tag::SPAN_TYPE, Type::SQL);
            $span->setTag(Tag::SERVICE_NAME, 'ORM');
            $span->setTag(Tag::RESOURCE_NAME, 'Model.find');
            $span->setTraceAnalyticsCandidate();

            return include __DIR__ . '/../../try_catch_finally.php';
        });


        dd_trace('Phalcon\Mvc\Model', 'query', function () {
            $tracer = GlobalTracer::get();
            if ($tracer->limited()) {
                return dd_trace_forward_call();
            }

            $scope = $tracer->startIntegrationScopeAndSpan(
                PhalconIntegration::getInstance(),
                'Model.query'
            );

            $span = $scope->getSpan();
            $span->setTag(Tag::SPAN_TYPE, Type::SQL);
            $span->setTag(Tag::SERVICE_NAME, 'ORM');
            $span->setTag(Tag::RESOURCE_NAME, 'Model.query');
            $span->setTraceAnalyticsCandidate();

            return include __DIR__ . '/../../try_catch_finally.php';
        });


        return Integration::LOADED;
    }




}