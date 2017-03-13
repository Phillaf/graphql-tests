<?php

namespace App\Core\Test;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

trait Seeder
{
    public function setUp()
    {
        $phinx = new TextWrapper(new PhinxApplication(), [
            'environment' => 'default',
            'configuration' => 'phinx.yml',
            'parser' => 'yaml',
        ]);
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
