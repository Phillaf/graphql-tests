<?php

require_once '../vendor/autoload.php';

use Silex\Application;
use Youshido\Silex\Provider\GraphQLControllerProvider;
use Youshido\GraphQL\Schema\Schema;

$app = new Application();

require_once __DIR__ . '/query.php';
require_once __DIR__ . '/mutation.php';

$schema = new Schema([
    'query' => $query,
    'mutaiton' => $mutation,
]);

$app->mount('/', new GraphQLControllerProvider($schema));

$app->run();
