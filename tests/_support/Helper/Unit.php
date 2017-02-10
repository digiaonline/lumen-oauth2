<?php
namespace Helper;

use Nord\Lumen\OAuth2\Tests\MockAccessToken;
use Nord\Lumen\OAuth2\Tests\MockAccessTokenStorage;
use Nord\Lumen\OAuth2\Tests\MockAuthorizationServer;
use Nord\Lumen\OAuth2\Tests\MockClientStorage;
use Nord\Lumen\OAuth2\Tests\MockScopeStorage;
use Nord\Lumen\OAuth2\Tests\MockSessionStorage;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Unit extends \Codeception\Module
{
    /**
     * Adds the "Authorization" header to the $_SERVER global.
     */
    public static function setAuthorizationHeader()
    {
        $_SERVER['HTTP_AUTHORIZATION'] = implode(' ', array(MockAccessToken::$tokenType, MockAccessToken::$accessToken));
    }

    /**
     * @return MockAuthorizationServer
     */
    public static function createAuthorizationServer()
    {
        return new MockAuthorizationServer();
    }

    /**
     * @return \League\OAuth2\Server\ResourceServer
     */
    public static function createResourceServer()
    {
        return new \League\OAuth2\Server\ResourceServer(
            new MockSessionStorage(),
            new MockAccessTokenStorage(),
            new MockClientStorage(),
            new MockScopeStorage()
        );
    }
}
