<?php namespace Nord\Lumen\OAuth2\Eloquent\Storages;

use Jenssegers\Date\Date;
use League\OAuth2\Server\Entity\RefreshTokenEntity;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use Nord\Lumen\OAuth2\Eloquent\Models\AccessToken;
use Nord\Lumen\OAuth2\Eloquent\Models\RefreshToken;
use Nord\Lumen\OAuth2\Exceptions\RefreshTokenNotFound;

class RefreshTokenStorage extends EloquentStorage implements RefreshTokenInterface
{

    /**
     * @inheritdoc
     */
    public function get($token)
    {
        $refreshToken = $this->findByToken($token);

        return $this->createEntity($refreshToken);
    }


    /**
     * @inheritdoc
     */
    public function create($token, $expireTime, $accessToken)
    {
        $accessToken = AccessToken::findByToken($accessToken);

        $refreshToken = RefreshToken::create([
            'access_token_id' => $accessToken->getKey(),
            'token'           => $token,
            'expire_time'     => Date::createFromTimestampUTC($expireTime)->format('Y-m-d H:i:s'),
        ]);

        return $this->createEntity($refreshToken);
    }


    /**
     * @inheritdoc
     */
    public function delete(RefreshTokenEntity $token)
    {
        $this->findByToken($token->getId())->delete();
    }


    /**
     * @param RefreshToken $refreshToken
     *
     * @return RefreshTokenEntity
     */
    protected function createEntity(RefreshToken $refreshToken)
    {
        $entity = new RefreshTokenEntity($this->server);

        $entity->setId($refreshToken->token);
        $entity->setAccessTokenId($refreshToken->accessTokenId);
        $entity->setExpireTime($refreshToken->expireTime);

        return $entity;
    }

    /**
     * @param string $token
     *
     * @return RefreshToken
     * @throws RefreshTokenNotFound
     */
    protected function findByToken($token)
    {
        $refreshToken = RefreshToken::findByToken($token);

        if ($refreshToken === null) {
            throw new RefreshTokenNotFound;
        }

        return $refreshToken;
    }
}
