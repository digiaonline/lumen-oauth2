<?php

namespace Nord\Lumen\OAuth2\Tests;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\AuthCodeInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;

class MockStorageServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function register()
    {
        $this->registerContainerBindings($this->app);
    }

    /**
     *
     */
    protected function registerContainerBindings(Container $container)
    {
        $container->bind(MockAccessTokenStorage::class, function () {
            return new MockAccessTokenStorage;
        });

        $container->bind(MockClientStorage::class, function () {
            return new MockClientStorage;
        });

        $container->bind(MockAuthCodeStorage::class, function () {
            return new MockAuthCodeStorage();
        });

        $container->bind(MockRefreshTokenStorage::class, function () {
            return new MockRefreshTokenStorage;
        });

        $container->bind(MockScopeStorage::class, function () {
            return new MockScopeStorage;
        });

        $container->bind(MockSessionStorage::class, function () {
            return new MockSessionStorage;
        });

        $container->bind(AccessTokenInterface::class, MockAccessTokenStorage::class);
        $container->bind(AuthCodeInterface::class, MockAuthCodeStorage::class);
        $container->bind(ClientInterface::class, MockClientStorage::class);
        $container->bind(RefreshTokenInterface::class, MockRefreshTokenStorage::class);
        $container->bind(ScopeInterface::class, MockScopeStorage::class);
        $container->bind(SessionInterface::class, MockSessionStorage::class);
    }
}
