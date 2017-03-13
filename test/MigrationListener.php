<?php

namespace App\Test;

use PHPUnit\Framework\BaseTestListener;
use PHPUnit\Framework\TestSuite;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

class MigrationListener extends BaseTestListener
{
    public function startTestSuite(TestSuite $suite)
    {
        if ($suite->getName() === 'Unit') {
            $phinx = new TextWrapper(new PhinxApplication(), [
                'environment' => 'default',
                'configuration' => 'phinx.yml',
                'parser' => 'yaml',
            ]);
            $phinx->getMigrate();
        }
    }

    public function endTestSuite(TestSuite $suite)
    {
        if ($suite->getName() === 'Unit') {
        }
    }
}
