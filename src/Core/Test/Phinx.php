<?php

namespace App\Core\Test;

use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;

class Phinx
{
    public static function get()
    {
        return new TextWrapper(new PhinxApplication(), [
            'environment' => 'default',
            'configuration' => 'phinx.yml',
            'parser' => 'yaml',
        ]);
    }
}
