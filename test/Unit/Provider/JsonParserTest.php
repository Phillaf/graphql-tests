<?php

namespace App\Test\Unit\Provider;

use App\Application;
use App\Provider\JsonParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class JsonParserTest extends TestCase
{
    private $app;
    private $data;
    private $register;
    private $request;

    public function setUp()
    {
        $this->app = new Application();
        $this->data = ['sup' => 'dude'];
        $this->request = Request::create('/', 'post', [], [], [], [], json_encode($this->data));
    }

    /** @test */
    public function defaultJsonIsNotParsed()
    {
        $response = $this->app->handle($this->request);
        $this->assertEquals(null, $this->request->get('sup'));
    }

    /** @test */
    public function jsonHeaderIsParsed()
    {
        $this->request->headers->set('Content-Type', 'application/json');
        $response = $this->app->handle($this->request);
        $this->assertEquals('dude', $this->request->get('sup'));
    }
}
