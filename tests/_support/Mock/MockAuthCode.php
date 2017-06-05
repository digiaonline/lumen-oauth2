<?php

namespace Nord\Lumen\OAuth2\Tests;

class MockAuthCode
{
    /**
     * @var string
     */
    public static $code = 'tb89gB5f-4_1JqM';

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
            'code'  => self::$code,
            'token_type'    => self::$tokenType,
            'expires_in'    => self::$expiresIn,
            'refresh_token' => self::$refreshToken
        ];
    }
}
