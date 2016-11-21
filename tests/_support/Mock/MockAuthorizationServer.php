<?php

namespace Nord\Lumen\OAuth2\Tests;

use League\OAuth2\Server\AuthorizationServer;

class MockAuthorizationServer extends AuthorizationServer
{
    /**
     * @inheritdoc
     */
    public function issueAccessToken()
    {
        return MockAccessToken::toArray();
    }
}
