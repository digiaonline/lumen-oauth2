<?php

require_once __DIR__ . '/../_support/Mock/MockStorageServiceProvider.php';

use Nord\Lumen\OAuth2\OAuth2ServiceProvider;
use Nord\Lumen\OAuth2\Middleware\OAuth2Middleware;

class OAuth2MiddlewareTest extends \Codeception\TestCase\Test
{
    use Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

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
            $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer mF_9.B5f-4.1JqM';
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
            verify($res)->isInstanceOf(Illuminate\Http\JsonResponse::class);
            verify((array)$res->getData())->equals(['message' => 'ERROR.ACCESS_DENIED']);
        });
    }

    /**
     * @return \Illuminate\Http\Request
     */
    private function createRequest()
    {
        $req = $this->getMockBuilder(\Illuminate\Http\Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $req;
    }
}
