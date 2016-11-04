<?php

namespace Nord\Lumen\OAuth2\Eloquent\Storages;

use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\SessionInterface;
use Nord\Lumen\OAuth2\Eloquent\Models\AccessToken;
use Nord\Lumen\OAuth2\Eloquent\Models\Client;
use Nord\Lumen\OAuth2\Eloquent\Models\Session;
use Nord\Lumen\OAuth2\Exceptions\ClientNotFound;
use Nord\Lumen\OAuth2\Exceptions\SessionNotFound;

class SessionStorage extends EloquentStorage implements SessionInterface
{
    /**
     * {@inheritdoc}
     */
    public function getByAccessToken(AccessTokenEntity $entity)
    {
        $accessToken = AccessToken::findByToken($entity->getId());

        /** @var Session $session */
        $session = Session::find($accessToken->session_id);

        if ($session === null) {
            throw new SessionNotFound();
        }

        return $this->createEntity($session);
    }

    /**
     * {@inheritdoc}
     */
    public function getByAuthCode(AuthCodeEntity $authCode)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function getScopes(SessionEntity $session)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function create($ownerType, $ownerId, $clientId, $clientRedirectUri = null)
    {
        $client = Client::findByKey($clientId);

        if ($client === null) {
            throw new ClientNotFound();
        }

        $session = Session::create([
            'client_id'           => $client->getKey(),
            'owner_type'          => $ownerType,
            'owner_id'            => $ownerId,
            'client_redirect_uri' => $clientRedirectUri,
        ]);

        return $session->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function associateScope(SessionEntity $session, ScopeEntity $scope)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @param Session $session
     *
     * @return SessionEntity
     */
    protected function createEntity(Session $session)
    {
        $entity = new SessionEntity($this->server);

        $entity->setId($session->getKey());
        $entity->setOwner($session->owner_type, $session->owner_id);

        return $entity;
    }
}
