<?php

namespace App\Test\Unit\Provider;

use App\Application;
use App\Provider\JsonParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class JwtParserTest extends TestCase
{
    private $app;
    private $data;
    private $request;

    public function setUp()
    {
        $this->app = new Application();
        $this->data = ['token' => 'dude'];
        $this->request = Request::create('/', 'post', $this->data);
    }

    /** @test */
    public function tokenIsParsed()
    {
        $response = $this->app->handle($this->request);
        $this->assertEquals('hello', $this->request->get('user'));
    }
}
