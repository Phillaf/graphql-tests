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
        $app->before(function (Request $request) {
            $request->attributes->set('user', 'hello');
        });
    }
}
