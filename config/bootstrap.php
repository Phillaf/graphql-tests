<?php

require_once '../vendor/autoload.php';

use App\Schema\Schema;
use Cake\Datasource\ConnectionManager;
use Silex\Application;
use Youshido\Silex\Provider\GraphQLControllerProvider;

$app = new Application();

require_once __DIR__ . '/query.php';
require_once __DIR__ . '/mutation.php';

ConnectionManager::setConfig('default', [
    'className' => 'Cake\Database\Connection',
    'driver' => 'Cake\Database\Driver\Mysql',
    'database' => 'app',
    'username' => 'root',
    'password' => '',
    'cacheMetadata' => false, // If set to `true` you need to install the optional "cakephp/cache" package.
    'host' => '127.0.0.1',
]);

$schema = new Schema();

$app->mount('/', new GraphQLControllerProvider($schema));

$app->run();
