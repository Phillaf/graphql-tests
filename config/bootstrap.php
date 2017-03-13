<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Schema\Schema;
use Cake\Datasource\ConnectionManager;
use Silex\Application;
use Youshido\Silex\Provider\GraphQLControllerProvider;

ConnectionManager::setConfig('default', [
    'className' => 'Cake\Database\Connection',
    'driver' => 'Cake\Database\Driver\Mysql',
    'database' => 'app',
    'username' => 'root',
    'password' => '',
    'cacheMetadata' => false, // If set to `true` you need to install the optional "cakephp/cache" package.
    'host' => '127.0.0.1',
]);

$app = new Application();
$app->mount('/', new GraphQLControllerProvider(new Schema()));
