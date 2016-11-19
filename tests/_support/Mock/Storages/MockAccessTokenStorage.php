<?php

require_once 'MockStorage.php';

use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Exception\AccessDeniedException;
use League\OAuth2\Server\Storage\AccessTokenInterface;

class MockAccessTokenStorage extends MockStorage implements AccessTokenInterface
{
    /**
     * @inheritdoc
     */
    public function get($token)
    {
        $entity = new AccessTokenEntity($this->server);

        $entity->setId('mF_9.B5f-4.1JqM');
        $entity->setExpireTime(time() + 24*60*60); // NOW + 24h

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function getScopes(AccessTokenEntity $token)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function create($token, $expireTime, $sessionId)
    {
    }

    /**
     * @inheritdoc
     */
    public function associateScope(AccessTokenEntity $token, ScopeEntity $scope)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function delete(AccessTokenEntity $token)
    {
    }
}
