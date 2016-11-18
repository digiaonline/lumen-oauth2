<?php

require_once 'MockStorage.php';

use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\SessionInterface;

class MockSessionStorage extends MockStorage implements SessionInterface
{
    /**
     * @inheritdoc
     */
    public function getByAccessToken(AccessTokenEntity $entity)
    {
        $entity = new SessionEntity($this->server);

        $entity->setId('test');
        $entity->setOwner('test', 'test');

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function getByAuthCode(AuthCodeEntity $authCode)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function getScopes(SessionEntity $session)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @inheritdoc
     */
    public function create($ownerType, $ownerId, $clientId, $clientRedirectUri = null)
    {
        return 1;
    }

    /**
     * @inheritdoc
     */
    public function associateScope(SessionEntity $session, ScopeEntity $scope)
    {
        throw new \Exception('Not implemented');
    }
}
