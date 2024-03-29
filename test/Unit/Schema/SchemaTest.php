<?php

namespace App\Test\Unit\Schema;

use App\Test\Database;
use App\Schema\Schema;
use PHPUnit\Framework\TestCase;
use Youshido\GraphQL\Execution\Processor;

class SchemaTest extends TestCase
{
    public function setUp()
    {
        Database::seed(['Posts']);
    }

    public function tearDown()
    {
        Database::truncate(['Posts']);
    }

    public function testLatestPost()
    {
        $result = $this->process('{ latestPost {title, body} }');
        $expected = '{"data":{"latestPost":{"title":"Post 1","body":"Content 1"}}}';
        $this->assertEquals($expected, $result);
    }

    private function process(string $request) : string
    {
        $processor = new Processor(new Schema());

        $processor
            ->getExecutionContext()
            ->getContainer()
            ->set('user', 'hello!');

        $response = $processor->processPayload($request)->getResponseData();
        return json_encode($response);
    }
}
