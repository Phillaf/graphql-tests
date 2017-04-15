<?php

namespace App\Provider;

use App\Auth\User;
use App\Controller;
use App\Schema\Schema;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Youshido\GraphQL\Execution\Processor as GraphQLProcessor;

class FrameworkProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['schema'] = function ($app) {
            return new Schema();
        };

        $app['processor'] = function ($app) {
            return new GraphQLProcessor($app['schema']);
        };

        $app['controller'] = function ($app) {
            $app['user'] = $app['user'] ?? new User;
            return new Controller($app['processor'], $app['user']);
        };
    }
}
