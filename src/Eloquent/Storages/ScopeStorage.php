<?php namespace Nord\Lumen\OAuth2\Eloquent\Storages;

use League\OAuth2\Server\Storage\ScopeInterface;

class ScopeStorage extends EloquentStorage implements ScopeInterface
{

    /**
     * @inheritdoc
     */
    public function get($scope, $grantType = null, $clientId = null)
    {
        throw new \Exception('Not implemented');
    }
}
