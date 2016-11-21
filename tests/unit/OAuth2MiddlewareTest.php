<?php

namespace Nord\Lumen\OAuth2\Tests;

use Helper\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nord\Lumen\OAuth2\OAuth2ServiceProvider;
use Nord\Lumen\OAuth2\Middleware\OAuth2Middleware;

class OAuth2MiddlewareTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var MockApplication
     */
    private $app;

    /**
     * @var OAuth2Middleware
     */
    private $middleware;

    /**
     * @inheritdoc
     */
    protected function setup()
    {
        $this->app = new MockApplication();
        $this->app->register(MockStorageServiceProvider::class);
        $this->app->register(OAuth2ServiceProvider::class);

        $this->middleware = new OAuth2Middleware();
    }

    /**
     *
     */
    public function testAssertValidAccessToken()
    {
        $this->specify('verify middleware valid access token', function () {
            Unit::setAuthorizationHeader();
            verify($this->middleware->handle(new Request(), function () {
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
            $res = $this->middleware->handle(new Request(), function () {
                return true;
            });
            verify($res)->isInstanceOf(JsonResponse::class);
            verify((array)$res->getData())->equals(['message' => 'ERROR.ACCESS_DENIED']);
        });
    }
}
