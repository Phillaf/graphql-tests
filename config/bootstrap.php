<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Cake\Core\Configure;
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

Configure::write('jwt', [
    'issuer' => 'http://issuer.com',
    'audience' => 'http://audience.com',
    'subject' => '_userId_',
    'expiration' => '3600',
    'idLength' => '16',
    'key' => 'testing',
]);

Configure::write('App', [
    'namespace' => 'App',
]);
