<?php

namespace App\Test\Unit\Schema;

use App\Schema\Schema;
use PHPUnit\Framework\TestCase;
use Youshido\GraphQL\Execution\Processor;
use App\Core\Test\Seeder;

class SchemaTest extends TestCase
{
    use Seeder;

    private $seeds = [
        'Posts',
    ];

    /** @test */
    public function latestPost()
    {
        $result = $this->process('{ latestPost {title, body} }');
        $expected = '{"data":{"latestPost":{"title":"Post 1","body":"Content 1"}}}';
        $this->assertEquals($expected, $result);
    }

    /** @test */
    public function likePost()
    {
        $result = $this->process('mutation { likePost(id: 5) }');
        $expected = '{"data":{"likePost":2}}';
        $this->assertEquals($expected, $result);
    }

    private function process(string $request) : string
    {
        $processor = new Processor(new Schema());
        $response = $processor->processPayload($request)->getResponseData();
        return json_encode($response);
    }
}
