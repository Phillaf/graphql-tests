<?php

namespace App\Test\Unit\Provider;

use App\Provider\JsonParser;
use PHPUnit\Framework\TestCase;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class JsonParserTest extends TestCase
{
    private $app;
    private $data;
    private $request;

    public function setUp()
    {
        $this->app = (new Application())->register(new JsonParser());
        $this->app->match('/', function () {
        });

        $this->data = ['sup' => 'dude'];
        $this->request = Request::create('/', 'post', [], [], [], [], json_encode($this->data));
    }

    /** @test */
    public function defaultJsonIsNotParsed()
    {
        $this->app->handle($this->request);
        $this->assertEquals(null, $this->request->get('sup'));
    }

    /** @test */
    public function jsonHeaderIsParsed()
    {
        $this->request->headers->set('Content-Type', 'application/json');
        $this->app->handle($this->request);
        $this->assertEquals('dude', $this->request->get('sup'));
    }
}
