<?php

namespace Nord\Lumen\OAuth2\Tests;

class MockAccessToken
{
    /**
     * @var string
     */
    public static $accessToken = 'mF_9.B5f-4.1JqM';

    /**
     * @var string
     */
    public static $tokenType = 'Bearer';

    /**
     * @var int
     */
    public static $expiresIn = 3600;

    /**
     * @var string
     */
    public static $refreshToken = 'tGzv3JOkF0XG5Qx2TlKWIA';

    /**
     * @return array
     */
    public static function toArray()
    {
        return [
            'access_token'  => self::$accessToken,
            'token_type'    => self::$tokenType,
            'expires_in'    => self::$expiresIn,
            'refresh_token' => self::$refreshToken
        ];
    }
}
