<?php

namespace App\Test\Unit\Provider;

use App\Controller;
use App\Provider\ControllerProvider;
use PHPUnit\Framework\TestCase;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ControllerProviderTest extends TestCase
{
    private $app;
    private $request;

    public function setUp()
    {
        $this->app = (new Application())->mount('/', new ControllerProvider());
        $this->app['controller'] = $this->createMock(Controller::class);

        $this->data = [
            'query' => 'hey',
            'variables' => ['sup' => 'dude'],
        ];

        $this->response = ['nice' => 'response'];

        $this->request = Request::create('/', 'post', $this->data);
    }

    /** @test */
    public function passesQuery()
    {
        $this->app['controller']
            ->expects($this->once())
            ->method('execute')
            ->with($this->data['query'], $this->data['variables']);

        $this->app->handle($this->request);
    }

    /** @test */
    public function returnsJson()
    {
        $response = ['some' => 'response'];
        $this->app['controller']
            ->method('execute')
            ->willReturn($response);

        $result = $this->app->handle($this->request);
        $expected = json_encode($response);

        $this->assertEquals($expected, $result->getContent());
    }
}
