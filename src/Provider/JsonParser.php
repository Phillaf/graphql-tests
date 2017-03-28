<?php

namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class JsonParser implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app->before(function (Request $request) {
            if ($request->headers->get('Content-Type') == 'application/json') {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : []);
            }
        });
    }
}
