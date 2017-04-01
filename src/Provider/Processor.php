<?php

namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Youshido\GraphQL\Execution\Processor as GraphQLProcessor;

class Processor implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['schema_class'] = 'App\\Schema\\Schema';

        $app['schema'] = function ($app) {
            return new $app['schema_class']();
        };

        $app['processor'] = function ($app) {
            return new GraphQLProcessor($app['schema']);
        };

        $app['processor_context'] = function ($app) {
            return $app['processor']->getExecutionContext()->getContainer();
        };
    }
}
