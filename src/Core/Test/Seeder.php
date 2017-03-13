<?php

namespace App\Core\Test;

use App\Core\Test\Phinx;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

trait Seeder
{
    public function setUp()
    {
        $phinx = Phinx::get();
        foreach ($this->seeds as $seed) {
            $phinx->getSeed(null, null, $seed);
        }
    }

    public function tearDown()
    {
        $db = ConnectionManager::get('default');
        foreach ($this->seeds as $seed) {
            $sql = TableRegistry::get($seed)->getSchema()->truncateSql($db);

            foreach ($sql as $stmt) {
                $db->execute($stmt)->closeCursor();
            }
        }
    }
}
