<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cake\Datasource\ConnectionManager;

ConnectionManager::setConfig('default', [
    'className' => 'Cake\Database\Connection',
    'driver' => 'Cake\Database\Driver\Mysql',
    'database' => 'app',
    'username' => 'root',
    'password' => '',
    'cacheMetadata' => false, // If set to `true` you need to install the optional "cakephp/cache" package.
    'host' => '127.0.0.1',
]);
