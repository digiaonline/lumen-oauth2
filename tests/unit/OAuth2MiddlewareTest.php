<?php

namespace Nord\Lumen\OAuth2\Tests;

use Nord\Lumen\OAuth2\OAuth2ServiceProvider;
use Nord\Lumen\OAuth2\Middleware\OAuth2Middleware;

class OAuth2MiddlewareTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var MockApplication
     */
    protected $app;

    /**
     * @inheritdoc
     */
    protected function setup()
    {
        $this->app = new MockApplication();
        $this->app->register(MockStorageServiceProvider::class);
        $this->app->register(OAuth2ServiceProvider::class);
    }

    /**
     *
     */
    public function testAssertValidAccessToken()
    {
        $this->specify('verify middleware valid access token', function () {
            \Helper\Unit::setAuthorizationHeader();
            $middleware = new OAuth2Middleware();
            verify($middleware->handle($this->createRequest(), function () {
                return true;
            }))->equals(true);
        });
    }

    /**
     *
     */
    public function testAssertInvalidAccessToken()
    {
        $this->specify('verify middleware invalid access token', function () {
            $middleware = new OAuth2Middleware();
            $res = $middleware->handle($this->createRequest(), function () {
                return true;
            });
            verify($res)->isInstanceOf(\Illuminate\Http\JsonResponse::class);
            verify((array)$res->getData())->equals(['message' => 'ERROR.ACCESS_DENIED']);
        });
    }

    /**
     * @return \Illuminate\Http\Request
     */
    private function createRequest()
    {
        return new \Illuminate\Http\Request();
    }
}
