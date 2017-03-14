<?php

namespace App\Core\Test;

use App\Schema\Schema;
use Youshido\GraphQL\Execution\Processor;

trait AssertResponse
{
    private function assertResponse(string $expected) : void
    {
        $processor = new Processor(new Schema());
        $response = $processor->processPayload($this->request)->getResponseData();
        $this->assertEquals($expected, json_encode($response));
    }
}
