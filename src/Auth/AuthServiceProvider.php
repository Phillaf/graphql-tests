<?php

namespace App\Auth;

use App\Auth\Auth;
use Cake\Core\Configure;
use Lcobucci\JWT\ValidationData;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AuthServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['auth_config'] = [
            'issuer' => 'http://issuer',
            'audience' => 'http://audience',
            'subject' => 'http://subject',
            'key' => 'this is the key',
        ];

        $app['auth_validation_data'] = function ($app) {
            $validationData = new ValidationData();
            $validationData->setIssuer($app['auth_config']['issuer']);
            $validationData->setAudience($app['auth_config']['audience']);
            $validationData->setSubject($app['auth_config']['subject']);
            return $validationData;
        };

        $app['auth_jwt'] = function ($app) {
            return new Jwt(
                $app['auth_config']['key'],
                $app['auth_validation_data']
            );
        };

        $app['auth'] = function ($app) {
            return new Auth($app['auth_jwt']);
        };

        $app->before(function (Request $request, Application $app) {
            $token = $request->server->get('Authorization', '');
            $app['user'] = $app['auth']->getUser($token);
        });
    }
}
