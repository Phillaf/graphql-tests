<?php

namespace App;

use Silex\Application as BaseApplication;
use App\Provider\JsonParser;
use App\Auth\AuthServiceProvider;
use App\Provider\FrameworkProvider;
use App\Provider\ControllerProvider;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct();

        $this->register(new JsonParser());
        $this->register(new AuthServiceProvider());
        $this->register(new FrameworkProvider());
        $this->mount('/', new ControllerProvider());
    }
}
