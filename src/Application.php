<?php

namespace App;

use App\Provider\Controller;
use App\Provider\JwtParser;
use App\Provider\JsonParser;
use App\Provider\Processor;
use Silex\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct();

        $this->register(new JwtParser());
        $this->register(new JsonParser());
        $this->register(new Processor());
        $this->mount('/', new Controller());
    }
}
