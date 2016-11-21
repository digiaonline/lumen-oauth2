<?php
namespace Helper;

use \Nord\Lumen\OAuth2\Tests\MockAccessToken;

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
}
