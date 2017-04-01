<?php

namespace App\Test;

use App\Test\Phinx;
use PHPUnit\Framework\BaseTestListener;
use PHPUnit\Framework\TestSuite;

class MigrationListener extends BaseTestListener
{
    public function startTestSuite(TestSuite $suite)
    {
        if ($suite->getName() === 'Unit') {
            Phinx::get()->getMigrate();
        }
    }

    public function endTestSuite(TestSuite $suite)
    {
        if ($suite->getName() === 'Unit') {
        }
    }
}
