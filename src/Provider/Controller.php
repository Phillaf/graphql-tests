<?php

namespace App\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class Controller implements ControllerProviderInterface
{
    protected $schema;

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers
            ->match('/', function (Application $app, Request $request) {
                $query = $request->get('query', '');
                $variables = $request->get('variables', []);
                $user = $request->get('user', []);

                $app['processor_context']->set('user', $user);
                $app['processor']->processPayload($query, $variables);

                return $app->json($app['processor']->getResponseData());
            });

        return $controllers;
    }
}
