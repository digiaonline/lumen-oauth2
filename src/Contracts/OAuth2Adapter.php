<?php namespace Nord\Lumen\OAuth2\Contracts;

use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;

interface OAuth2Adapter
{

    /**
     * @return AccessTokenInterface
     */
    public function getAccessTokenStorage();


    /**
     * @return ClientInterface
     */
    public function getClientStorage();


    /**
     * @return RefreshTokenInterface
     */
    public function getRefreshTokenStorage();


    /**
     * @return ScopeInterface
     */
    public function getScopeStorage();


    /**
     * @return SessionInterface
     */
    public function getSessionStorage();
}
