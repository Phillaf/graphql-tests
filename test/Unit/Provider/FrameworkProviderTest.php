<?php

namespace App\Test\Unit\Provider;

use App\Controller;
use App\Provider\FrameworkProvider;
use App\Schema\Schema;
use PHPUnit\Framework\TestCase;
use Silex\Application;
use Youshido\GraphQL\Execution\Processor;

class FrameworkProviderTest extends TestCase
{
    public function setUp()
    {
        $this->app = (new Application())->register(new FrameworkProvider());
    }

    /** @test */
    public function schemaExists()
    {
        $schema = $this->app['schema'];
        $this->assertEquals(Schema::class, get_class($schema));
    }

    /** @test */
    public function processorExists()
    {
        $processor = $this->app['processor'];
        $this->assertEquals(Processor::class, get_class($processor));
    }

    /** @test */
    public function controllerExists()
    {
        $controller = $this->app['controller'];
        $this->assertEquals(get_class($controller), Controller::class);
    }
}
