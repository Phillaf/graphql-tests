<?php

namespace App\Test\Unit\Provider;

use App\Application;
use App\Provider\Controller;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Youshido\GraphQL\Execution\Processor;

class ControllerTest extends TestCase
{
    private $app;
    private $processor;
    private $request;

    public function setUp()
    {
        $this->app = new Application();
        $this->app['processor'] = $this->createMock(Processor::class);

        $this->data = [
            'query' => 'hey',
            'variables' => ['sup' => 'bro'],
        ];

        $this->request = Request::create('/', 'post', $this->data);
    }

    /** @test */
    public function processIsCalled()
    {
        $this->app['processor']
            ->expects($this->once())
            ->method('processPayload')
            ->with($this->data['query'], $this->data['variables']);


        $this->app->handle($this->request);
    }

    /** @test */
    public function returnsExpected()
    {
        $this->app['processor']
            ->expects($this->once())
            ->method('getResponseData')
            ->willReturn($this->data);

        $result = $this->app->handle($this->request)->getContent();
        $expected = json_encode($this->data);

        $this->assertSame($expected, $result);
    }
}
