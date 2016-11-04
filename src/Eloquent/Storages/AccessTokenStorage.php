<?php

namespace Nord\Lumen\OAuth2\Eloquent\Storages;

use Carbon\Carbon;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Exception\AccessDeniedException;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use Nord\Lumen\OAuth2\Eloquent\Models\AccessToken;
use Nord\Lumen\OAuth2\Exceptions\AccessTokenNotFound;

class AccessTokenStorage extends EloquentStorage implements AccessTokenInterface
{
    /**
     * {@inheritdoc}
     */
    public function get($token)
    {
        $accessToken = $this->findByToken($token);

        if ($accessToken === null) {
            throw new AccessDeniedException();
        }

        return $this->createEntity($accessToken);
    }

    /**
     * {@inheritdoc}
     */
    public function getScopes(AccessTokenEntity $token)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function create($token, $expireTime, $sessionId)
    {
        AccessToken::create([
            'token'       => $token,
            'session_id'  => $sessionId,
            'expire_time' => Carbon::createFromTimestamp($expireTime)->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function associateScope(AccessTokenEntity $token, ScopeEntity $scope)
    {
        throw new \Exception('Not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function delete(AccessTokenEntity $token)
    {
        $accessToken = $this->findByToken($token->getId());

        if ($accessToken === null) {
            throw new AccessTokenNotFound();
        }

        $accessToken->delete();
    }

    /**
     * @param AccessToken $accessToken
     *
     * @return AccessTokenEntity
     */
    protected function createEntity(AccessToken $accessToken)
    {
        $entity = new AccessTokenEntity($this->server);

        $entity->setId($accessToken->token);
        $entity->setExpireTime(Carbon::createFromFormat('Y-m-d H:i:s', $accessToken->expire_time)->getTimestamp());

        return $entity;
    }

    /**
     * @param string $token
     *
     * @throws AccessTokenNotFound
     *
     * @return AccessToken
     */
    protected function findByToken($token)
    {
        return AccessToken::findByToken($token);
    }
}
