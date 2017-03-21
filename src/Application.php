<?php

namespace App;

use App\Core\Provider\GoogleOAuth;
use App\Schema\Schema;
use Silex\Application as BaseApplication;
use Youshido\Silex\Provider\GraphQLControllerProvider;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct();

        $this->register(new GoogleOAuth());
        $this->mount('/', new GraphQLControllerProvider(new Schema()));
    }
}
