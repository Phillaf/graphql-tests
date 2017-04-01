<?php

namespace App\Provider;

use App\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class JwtParser implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['auth_class'] = 'App\\Auth\\Auth';

        $app['auth'] = function ($app) {
            return new $app['auth_class']();
        };

        $app->before(function (Request $request, Application $app) {
            $token = $request->get('access_token');
            $app['user'] = $app['auth']->getUser($token);
        });
    }
}
