<?php

namespace App\Test\Unit;

use App\Application;
use App\Core\JwtFactory;
use App\Core\Test\Database;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ApplicationTest extends TestCase
{
    public function setUp()
    {
        Database::seed(['Posts']);
    }

    public function tearDown()
    {
        Database::truncate(['Posts']);
    }

    /** @test */
    public function build()
    {
        $result = $this->process(['query' => '{ latestPost {title, body} }']);
        $expected = '{"data":{"latestPost":{"title":"Post 1","body":"Content 1"}}}';
        $this->assertEquals($expected, $result);
    }

    private function process(array $data) : string
    {
        $request = Request::create('/', 'POST', $data);
        $request->headers->set('Authorization', 'Bearer _my_token_');
        $app = new Application();

        ob_start();
        $app->run($request);
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
