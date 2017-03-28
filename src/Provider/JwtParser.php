<?php

namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class JwtParser implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        return 'hello';
    }
}
