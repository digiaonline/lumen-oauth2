<?php namespace Nord\Lumen\OAuth2\Eloquent;

use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;
use Nord\Lumen\OAuth2\Eloquent\Storages\AccessTokenStorage;
use Nord\Lumen\OAuth2\Eloquent\Storages\ClientStorage;
use Nord\Lumen\OAuth2\Eloquent\Storages\RefreshTokenStorage;
use Nord\Lumen\OAuth2\Eloquent\Storages\ScopeStorage;
use Nord\Lumen\OAuth2\Eloquent\Storages\SessionStorage;
use Nord\Lumen\OAuth2\Contracts\OAuth2Adapter as OAuth2AdapterContract;
use Symfony\Component\HttpFoundation\Session\Session;

class EloquentAdapter implements OAuth2AdapterContract
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
        $this->accessTokenStorage  = new AccessTokenStorage();
        $this->clientStorage       = new ClientStorage();
        $this->refreshTokenStorage = new RefreshTokenStorage();
        $this->scopeStorage        = new ScopeStorage();
        $this->sessionStorage      = new SessionStorage();
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
