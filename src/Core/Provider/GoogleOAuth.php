<?php

namespace App\Core\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class GoogleOAuth implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        return 'hello';
    }
}
