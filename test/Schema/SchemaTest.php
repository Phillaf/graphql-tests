<?php

namespace App\Test\Schema;

use App\Schema\Schema;
use Cake\Datasource\ConnectionManager;
use PHPUnit\Framework\TestCase;
use Youshido\GraphQL\Execution\Processor;

class SchemaTest extends TestCase
{
    public function setUp()
    {
        ConnectionManager::setConfig('default', [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'database' => 'app',
            'username' => 'root',
            'password' => '',
            'cacheMetadata' => false, // If set to `true` you need to install the optional "cakephp/cache" package.
            'host' => '127.0.0.1',
        ]);
    }

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
