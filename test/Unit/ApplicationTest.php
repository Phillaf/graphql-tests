<?php

namespace App\Test\Unit;

use App\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ApplicationTest extends TestCase
{
    /** @test */
    public function build()
    {
        $app = new Application();
        ob_start();
        $app->run();
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertNotEquals($output, '');
    }
}

