<?php namespace Nord\Lumen\OAuth2\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;
use Nord\Lumen\OAuth2\Doctrine\Storages\AccessTokenStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\ClientStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\RefreshTokenStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\ScopeStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\SessionStorage;

class DoctrineStorageServiceProvider extends ServiceProvider
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
        $entityManager = $container->make(EntityManagerInterface::class);

        $container->bind(AccessTokenStorage::class, function () use ($entityManager) {
            return new AccessTokenStorage($entityManager);
        });

        $container->bind(ClientStorage::class, function () use ($entityManager) {
            return new ClientStorage($entityManager);
        });

        $container->bind(RefreshTokenStorage::class, function () use ($entityManager) {
            return new RefreshTokenStorage($entityManager);
        });

        $container->bind(ScopeStorage::class, function () use ($entityManager) {
            return new ScopeStorage($entityManager);
        });

        $container->bind(SessionStorage::class, function () use ($entityManager) {
            return new SessionStorage($entityManager);
        });

        $container->bind(AccessTokenInterface::class, AccessTokenStorage::class);
        $container->bind(ClientInterface::class, ClientStorage::class);
        $container->bind(RefreshTokenInterface::class, RefreshTokenStorage::class);
        $container->bind(ScopeInterface::class, ScopeStorage::class);
        $container->bind(SessionInterface::class, SessionStorage::class);
    }
}
