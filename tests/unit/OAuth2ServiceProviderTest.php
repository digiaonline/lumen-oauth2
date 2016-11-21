<?php

namespace Nord\Lumen\OAuth2\Tests;

use Nord\Lumen\OAuth2\OAuth2Facade;
use Nord\Lumen\OAuth2\OAuth2Service;
use Nord\Lumen\OAuth2\OAuth2ServiceProvider;

class OAuth2ServiceProviderTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;

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
        $this->app->withFacades();
        $this->app->register(MockStorageServiceProvider::class);
        $this->app->register(OAuth2ServiceProvider::class);
    }

    /**
     *
     */
    public function testAssertCanBeRegistered()
    {
        $this->specify('verify serviceProvider is registered', function () {
            $service = $this->app->make(OAuth2Service::class);
            verify($service)->isInstanceOf(OAuth2Service::class);
        });
    }

    /**
     *
     */
    public function testAssertFacade()
    {
        $this->specify('verify serviceProvider facade', function () {
            verify(OAuth2Facade::getFacadeRoot())->isInstanceOf(OAuth2Service::class);
        });
    }
}
