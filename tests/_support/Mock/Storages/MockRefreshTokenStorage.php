<?php

require_once 'MockStorage.php';

use League\OAuth2\Server\Entity\RefreshTokenEntity;
use League\OAuth2\Server\Storage\RefreshTokenInterface;

class MockRefreshTokenStorage extends MockStorage implements RefreshTokenInterface
{
    /**
     * @inheritdoc
     */
    public function get($token)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function create($token, $expireTime, $accessToken)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function delete(RefreshTokenEntity $token)
    {
    }
}
