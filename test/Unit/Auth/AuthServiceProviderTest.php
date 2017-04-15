<?php

namespace App\Test\Unit\Provider;

use App\Auth\Auth;
use App\Auth\AuthServiceProvider;
use App\Auth\Jwt;
use App\Provider\Controller;
use Lcobucci\JWT\ValidationData;
use PHPUnit\Framework\TestCase;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class AuthServiceProviderTest extends TestCase
{
    private $app;

    public function setUp()
    {
        $this->app = (new Application())->register(new AuthServiceProvider);
    }

    /** @test */
    public function configExists()
    {
        $config = $this->app['auth_config'];
        $this->assertFalse(empty($config));
    }

    /** @test */
    public function validationDataExists()
    {
        $validationData = $this->app['auth_validation_data'];
        $this->assertSame(ValidationData::class, get_class($validationData));
    }

    /** @test */
    public function jwtExists()
    {
        $jwt = $this->app['auth_jwt'];
        $this->assertSame(Jwt::class, get_class($jwt));
    }

    /** @test */
    public function authExists()
    {
        $auth = $this->app['auth'];
        $this->assertSame(Auth::class, get_class($auth));
    }


    /** @test */
    public function tokenIsParsed()
    {
        $this->app->get('/', function () {
            echo 'hi';
        });

        $expiration = strtotime('+1 minute', time());
        $data = ['email' => 'phil@phillafrance.com'];
        $token = $this->app['auth_jwt']->create($expiration, $data);

        $request = Request::create('/', 'GET', [], [], [], ['Authorization' => "Bearer $token"]);
        $this->app->handle($request);
        $user = $this->app['user'];

        $this->assertTrue($user->authenticated());
    }
}
