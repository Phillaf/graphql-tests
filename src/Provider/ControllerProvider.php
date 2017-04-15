<?php

namespace App\Provider;

use App\Controller;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ControllerProvider implements ControllerProviderInterface
{
    protected $schema;

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers
            ->match('/', function (Application $app, Request $request) {
                $query = $request->get('query', '');
                $variables = $request->get('variables', []);
                $response = $app['controller']->execute($query, $variables);
                return $app->json($response);
            });

        return $controllers;
    }

}
