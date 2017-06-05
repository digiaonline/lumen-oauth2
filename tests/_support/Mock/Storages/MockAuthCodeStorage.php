<?php

namespace Nord\Lumen\OAuth2\Tests;

use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\AuthCodeInterface;

class MockAuthCodeStorage extends MockStorage implements AuthCodeInterface
{
    /**
     * @inheritdoc
     */
    public function get($token)
    {
        $entity = new AuthCodeEntity($this->server);

        $entity->setId('tb89gB5f-4_1JqM');
        $entity->setExpireTime(time() + 24*60*60); // NOW + 24h

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function getScopes(AuthCodeEntity $token)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function create($token, $expireTime, $sessionId, $redirectUri)
    {
    }

    /**
     * @inheritdoc
     */
    public function associateScope(AuthCodeEntity $token, ScopeEntity $scope)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function delete(AuthCodeEntity $token)
    {
    }
}
