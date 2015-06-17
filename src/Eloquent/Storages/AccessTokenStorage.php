<?php namespace Nord\Lumen\OAuth2\Eloquent\Storages;

use Jenssegers\Date\Date;
use Nord\Lumen\OAuth2\Eloquent\Models\AccessToken;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use Nord\Lumen\OAuth2\Exceptions\AccessTokenNotFound;

class AccessTokenStorage extends EloquentStorage implements AccessTokenInterface
{

    /**
     * @inheritdoc
     */
    public function get($token)
    {
        $accessToken = $this->findByToken($token);

        return $this->createEntity($accessToken);
    }


    /**
     * @inheritdoc
     */
    public function getScopes(AccessTokenEntity $token)
    {
    }


    /**
     * @inheritdoc
     */
    public function create($token, $expireTime, $sessionId)
    {
        AccessToken::create([
            'token'       => $token,
            'session_id'  => $sessionId,
            'expire_time' => Date::createFromTimestamp($expireTime)->format('Y-m-d H:i:s'),
        ]);
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
        $this->findByToken($token->getId())->delete();
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
        $entity->setExpireTime(Date::createFromFormat('Y-m-d H:i:s', $accessToken->expire_time)->getTimestamp());

        return $entity;
    }


    /**
     * @param string $token
     *
     * @return AccessToken
     * @throws AccessTokenNotFound
     */
    protected function findByToken($token)
    {
        $accessToken = AccessToken::findByToken($token);

        if ($accessToken === null) {
            throw new AccessTokenNotFound;
        }

        return $accessToken;
    }
}
