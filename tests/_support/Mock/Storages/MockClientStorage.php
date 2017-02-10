<?php

namespace Nord\Lumen\OAuth2\Tests;

use League\OAuth2\Server\Entity\ClientEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\ClientInterface;

class MockClientStorage extends MockStorage implements ClientInterface
{
    /**
     * @inheritdoc
     */
    public function get($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
    {
        $entity = new ClientEntity($this->server);

        $entity->hydrate([
            'id'   => 'test',
            'name' => 'test',
        ]);

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function getBySession(SessionEntity $entity)
    {
        $entity = new ClientEntity($this->server);

        $entity->hydrate([
            'id'   => 'test',
            'name' => 'test',
        ]);

        return $entity;
    }
}
