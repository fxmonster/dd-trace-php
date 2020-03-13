<?php

require __DIR__ . '/../src/DDTrace/Log/LoggingTrait.php';
require __DIR__ . '/../src/DDTrace/Configuration/Registry.php';
require __DIR__ . '/../src/DDTrace/Contracts/Tracer.php';
require __DIR__ . '/../src/DDTrace/Contracts/Span.php';
require __DIR__ . '/../src/DDTrace/Contracts/Scope.php';
require __DIR__ . '/../src/DDTrace/Contracts/ScopeManager.php';
require __DIR__ . '/../src/DDTrace/Contracts/SpanContext.php';
require __DIR__ . '/../src/DDTrace/Data/SpanContext.php';
require __DIR__ . '/../src/DDTrace/Data/Span.php';
require __DIR__ . '/../src/DDTrace/Sampling/Sampler.php';
require __DIR__ . '/../src/DDTrace/Transport.php';
require __DIR__ . '/../src/DDTrace/SpanContext.php';
require __DIR__ . '/../src/DDTrace/Span.php';
require __DIR__ . '/../src/DDTrace/Tracer.php';
require __DIR__ . '/../src/DDTrace/Configuration/AbstractConfiguration.php';
require __DIR__ . '/../src/DDTrace/Configuration/EnvVariableRegistry.php';
require __DIR__ . '/../src/DDTrace/Obfuscation/WildcardToRegex.php';
require __DIR__ . '/../src/DDTrace/StartSpanOptionsFactory.php';
require __DIR__ . '/../src/DDTrace/Time.php';
require __DIR__ . '/../src/DDTrace/Transport/Http.php';
require __DIR__ . '/../src/DDTrace/Transport/Stream.php';
require __DIR__ . '/../src/DDTrace/Type.php';
require __DIR__ . '/../src/DDTrace/Encoder.php';
require __DIR__ . '/../src/DDTrace/Util/Runtime.php';
require __DIR__ . '/../src/DDTrace/Util/Versions.php';
require __DIR__ . '/../src/DDTrace/Util/ObjectKVStore.php';
require __DIR__ . '/../src/DDTrace/Util/ArrayKVStore.php';
require __DIR__ . '/../src/DDTrace/Util/TryCatchFinally.php';
require __DIR__ . '/../src/DDTrace/Util/CodeTracer.php';
require __DIR__ . '/../src/DDTrace/Util/ContainerInfo.php';
require __DIR__ . '/../src/DDTrace/Processing/TraceAnalyticsProcessor.php';
require __DIR__ . '/../src/DDTrace/Tag.php';
require __DIR__ . '/../src/DDTrace/Scope.php';
require __DIR__ . '/../src/DDTrace/Reference.php';
require __DIR__ . '/../src/DDTrace/Sampling/AlwaysKeepSampler.php';
require __DIR__ . '/../src/DDTrace/Sampling/PrioritySampling.php';
require __DIR__ . '/../src/DDTrace/Sampling/ConfigurableSampler.php';
require __DIR__ . '/../src/DDTrace/Propagator.php';
require __DIR__ . '/../src/DDTrace/Configuration.php';
require __DIR__ . '/../src/DDTrace/Bootstrap.php';
require __DIR__ . '/../src/DDTrace/Encoders/SpanEncoder.php';
require __DIR__ . '/../src/DDTrace/Encoders/MessagePack.php';
require __DIR__ . '/../src/DDTrace/Exceptions/InvalidReferenceArgument.php';
require __DIR__ . '/../src/DDTrace/Exceptions/UnsupportedFormat.php';
require __DIR__ . '/../src/DDTrace/Exceptions/InvalidSpanArgument.php';
require __DIR__ . '/../src/DDTrace/Exceptions/InvalidReferencesSet.php';
require __DIR__ . '/../src/DDTrace/Exceptions/InvalidSpanOption.php';

require __DIR__ . '/../src/DDTrace/GlobalTracer.php';
require __DIR__ . '/../src/DDTrace/Propagators/TextMap.php';
require __DIR__ . '/../src/DDTrace/Propagators/CurlHeadersMap.php';
require __DIR__ . '/../src/DDTrace/Http/Urls.php';
require __DIR__ . '/../src/DDTrace/Http/Request.php';
require __DIR__ . '/../src/DDTrace/ScopeManager.php';

// Integrations:
require __DIR__ . '/../src/DDTrace/Integrations/AbstractIntegrationConfiguration.php';
require __DIR__ . '/../src/DDTrace/Integrations/DefaultIntegrationConfiguration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Integration.php';
require __DIR__ . '/../src/DDTrace/Integrations/SandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/CakePHP/CakePHPIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/CodeIgniter/V2/CodeIgniterSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Web/WebIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Predis/PredisIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/IntegrationsLoader.php';
require __DIR__ . '/../src/DDTrace/Integrations/PDO/PDOIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/PDO/PDOSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Eloquent/EloquentIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Eloquent/EloquentSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Memcached/MemcachedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Memcached/MemcachedSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Curl/CurlIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mysqli/MysqliCommon.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mysqli/MysqliIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mysqli/MysqliSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mongo/MongoClientIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mongo/MongoDBIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mongo/MongoCollectionIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mongo/MongoIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Mongo/MongoSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Slim/SlimIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Symfony/SymfonyIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Symfony/SymfonySandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/ElasticSearch/V1/ElasticSearchCommon.php';
require __DIR__ . '/../src/DDTrace/Integrations/ElasticSearch/V1/ElasticSearchIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/ElasticSearch/V1/ElasticSearchSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Laravel/LaravelSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Laravel/LaravelIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Laravel/V4/LaravelIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Lumen/LumenIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Lumen/V5/LumenIntegrationLoader.php';
require __DIR__ . '/../src/DDTrace/Integrations/Guzzle/GuzzleIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Yii/V2/YiiIntegrationLoader.php';
require __DIR__ . '/../src/DDTrace/Integrations/Yii/YiiSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/WordPress/WordPressSandboxedIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/WordPress/V4/WordPressIntegrationLoader.php';
require __DIR__ . '/../src/DDTrace/Integrations/ZendFramework/ZendFrameworkIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/ZendFramework/ZendFrameworkSandboxedIntegration.php';

// Loggers
require __DIR__ . '/../src/DDTrace/Log/Logger.php';
require __DIR__ . '/../src/DDTrace/Log/LoggerInterface.php';
require __DIR__ . '/../src/DDTrace/Log/InterpolateTrait.php';
require __DIR__ . '/../src/DDTrace/Log/LogLevel.php';
require __DIR__ . '/../src/DDTrace/Log/AbstractLogger.php';
require __DIR__ . '/../src/DDTrace/Log/ErrorLogLogger.php';

require __DIR__ . '/../src/DDTrace/Obfuscation.php';
require __DIR__ . '/../src/DDTrace/Format.php';
require __DIR__ . '/../src/DDTrace/StartSpanOptions.php';


// Custom integrations
require __DIR__ . '/../src/DDTrace/Integrations/Redis/RedisIntegration.php';
require __DIR__ . '/../src/DDTrace/Integrations/Phalcon/PhalconIntegration.php';
