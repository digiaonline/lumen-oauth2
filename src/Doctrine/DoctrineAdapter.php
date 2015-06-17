<?php namespace Nord\Lumen\OAuth2\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Storages\AccessTokenInterface;
use League\OAuth2\Server\Storages\ClientInterface;
use League\OAuth2\Server\Storages\RefreshTokenInterface;
use League\OAuth2\Server\Storages\ScopeInterface;
use League\OAuth2\Server\Storages\SessionInterface;
use Nord\Lumen\OAuth2\Doctrine\Storages\AccessTokenStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\ClientStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\RefreshTokenStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\ScopeStorage;
use Nord\Lumen\OAuth2\Doctrine\Storages\SessionStorage;
use Nord\Lumen\OAuth2\Contracts\OAuth2Adapter as OAuth2AdapterContract;
use Symfony\Component\HttpFoundation\Session\Session;

class DoctrineAdapter implements OAuth2AdapterContract
{

    /**
     * @var AccessTokenInterface
     */
    private $accessTokenStorage;

    /**
     * @var ClientInterface
     */
    private $clientStorage;

    /**
     * @var RefreshTokenInterface
     */
    private $refreshTokenStorage;

    /**
     * @var ScopeInterface
     */
    private $scopeStorage;

    /**
     * @var SessionInterface
     */
    private $sessionStorage;


    /**
     * EloquentAdapter constructor.
     */
    public function __construct()
    {
        $entityManager = app(EntityManagerInterface::class);

        $this->accessTokenStorage  = new AccessTokenStorage($entityManager);
        $this->clientStorage       = new ClientStorage($entityManager);
        $this->refreshTokenStorage = new RefreshTokenStorage($entityManager);
        $this->scopeStorage        = new ScopeStorage($entityManager);
        $this->sessionStorage      = new SessionStorage($entityManager);
    }


    /**
     * @return AccessTokenInterface
     */
    public function getAccessTokenStorage()
    {
        return $this->accessTokenStorage;
    }


    /**
     * @return ClientInterface
     */
    public function getClientStorage()
    {
        return $this->clientStorage;
    }


    /**
     * @return RefreshTokenInterface
     */
    public function getRefreshTokenStorage()
    {
        return $this->refreshTokenStorage;
    }


    /**
     * @return ScopeInterface
     */
    public function getScopeStorage()
    {
        return $this->scopeStorage;
    }


    /**
     * @return SessionInterface
     */
    public function getSessionStorage()
    {
        return $this->sessionStorage;
    }
}
