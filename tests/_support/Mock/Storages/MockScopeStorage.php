<?php

namespace Nord\Lumen\OAuth2\Tests;

use League\OAuth2\Server\Storage\ScopeInterface;

class MockScopeStorage extends MockStorage implements ScopeInterface
{
    /**
     * @inheritdoc
     */
    public function get($scope, $grantType = null, $clientId = null)
    {
        throw new \Exception('Not implemented');
    }
}
