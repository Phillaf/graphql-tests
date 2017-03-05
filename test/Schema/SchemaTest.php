<?php

namespace App\Test\Schema;

use App\Schema\Schema;
use PHPUnit\Framework\TestCase;
use Youshido\GraphQL\Execution\Processor;

class SchemaTest extends TestCase
{
    /** @test */
    public function latestPost()
    {
        $result = $this->process('{ latestPost {title, summary} }');
        $expected = '{"data":{"latestPost":{"title":"Sup","summary":"Fellas"}}}';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function likePost()
    {
        $result = $this->process('mutation { likePost(id: 5) }');
        $expected = '{"data":{"latestPost":{"title":"Sup","summary":"Fellas"}}}';
        $this->assertEquals($expected, $result);
    }

    private function process(string $request) : string
    {
        $processor = new Processor(new Schema());
        $response = $processor->processPayload($request)->getResponseData();
        return json_encode($response);
    }
}
