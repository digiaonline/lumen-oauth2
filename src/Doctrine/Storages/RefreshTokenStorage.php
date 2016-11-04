<?php

namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entity\RefreshTokenEntity;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken;
use Nord\Lumen\OAuth2\Doctrine\Entities\RefreshToken;
use Nord\Lumen\OAuth2\Doctrine\Repositories\AccessTokenRepository;
use Nord\Lumen\OAuth2\Doctrine\Repositories\RefreshTokenRepository;
use Nord\Lumen\OAuth2\Exceptions\RefreshTokenNotFound;

class RefreshTokenStorage extends DoctrineStorage implements RefreshTokenInterface
{
    /**
     * @var RefreshTokenRepository
     */
    protected $refreshTokenRepository;

    /**
     * @var AccessTokenRepository
     */
    protected $accessTokenRepository;

    /**
     * RefreshTokenStorage constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->refreshTokenRepository = $this->entityManager->getRepository(RefreshToken::class);
        $this->accessTokenRepository = $this->entityManager->getRepository(AccessToken::class);
    }

    /**
     * {@inheritdoc}
     */
    public function get($token)
    {
        $refreshToken = $this->refreshTokenRepository->findByToken($token);

        if ($refreshToken === null) {
            throw new RefreshTokenNotFound();
        }

        return $this->createEntity($refreshToken);
    }

    /**
     * {@inheritdoc}
     */
    public function create($token, $expireTime, $accessToken)
    {
        $refreshToken = new RefreshToken(
            $token,
            $this->accessTokenRepository->findByToken($accessToken),
            Carbon::createFromTimestamp($expireTime)
        );

        $this->entityManager->persist($refreshToken);
        $this->entityManager->flush($refreshToken);

        return $this->createEntity($refreshToken);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(RefreshTokenEntity $token)
    {
        $refreshToken = $this->refreshTokenRepository->findByToken($token->getId());

        if ($refreshToken === null) {
            throw new RefreshTokenNotFound();
        }

        $this->entityManager->remove($refreshToken);
        $this->entityManager->flush($refreshToken);
    }

    /**
     * @param RefreshToken $refreshToken
     *
     * @return RefreshTokenEntity
     */
    protected function createEntity(RefreshToken $refreshToken)
    {
        $entity = new RefreshTokenEntity($this->server);

        $entity->setId($refreshToken->getToken());
        $entity->setAccessTokenId($refreshToken->getAccessToken()->getToken());
        $entity->setExpireTime($refreshToken->getExpireTime()->getTimestamp());

        return $entity;
    }
}
