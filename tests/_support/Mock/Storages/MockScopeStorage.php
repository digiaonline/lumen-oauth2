<?php

require_once 'MockStorage.php';

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
