<?php

namespace App\Test\Unit\Provider;

use App\Application;
use PHPUnit\Framework\TestCase;
use Youshido\GraphQL\Execution\Processor;

class ProcessorTest extends TestCase
{
    public function setUp()
    {
        $this->app = new Application();
    }

    /** @test */
    public function defaultSchemaExists()
    {
        $schemaClass = $this->app['schema_class'];
        $schema = $this->app['schema'];
        $this->assertEquals(get_class($schema), $schemaClass);
    }

    /** @test */
    public function processorIsBuilt()
    {
        $processor = $this->app['processor'];
        $this->assertEquals(get_class($processor), Processor::class);
    }
}
