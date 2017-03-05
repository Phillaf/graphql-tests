<?php

require_once '../vendor/autoload.php';

use App\Schema\Schema;
use Silex\Application;
use Youshido\Silex\Provider\GraphQLControllerProvider;

$app = new Application();

require_once __DIR__ . '/query.php';
require_once __DIR__ . '/mutation.php';

$schema = new Schema();

$app->mount('/', new GraphQLControllerProvider($schema));

$app->run();
