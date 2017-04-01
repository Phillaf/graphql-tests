<?php

namespace App\Test;

use App\Application;

trait AssertResponse
{
    /** @test */
    public function testOperation() : void
    {
        $app = new Application();

        $response = $app['processor']
            ->processPayload($this->request)
            ->getResponseData();

        $result = json_encode($response);
        $expected = json_encode($this->response);

        $this->assertEquals($expected, $result);
    }
}
