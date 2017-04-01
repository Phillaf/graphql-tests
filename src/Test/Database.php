<?php

namespace App\Test;

use App\Test\Phinx;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class Database
{
    public static function seed(array $seeds)
    {
        $phinx = Phinx::get();
        foreach ($seeds as $seed) {
            $phinx->getSeed(null, null, $seed);
        }
    }

    public static function truncate(array $tables)
    {
        $db = ConnectionManager::get('default');
        foreach ($tables as $table) {
            $sql = TableRegistry::get($table)->getSchema()->truncateSql($db);

            foreach ($sql as $stmt) {
                $db->execute($stmt)->closeCursor();
            }
        }
    }
}
