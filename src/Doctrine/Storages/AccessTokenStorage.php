<?php namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Jenssegers\Date\Date;
use Nord\Luemn\OAuth2\Exceptions\AccessTokenNotFound;
use Nord\Lumen\OAuth2\Doctrine\Repositories\SessionRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken;
use Nord\Lumen\OAuth2\Doctrine\Repositories\AccessTokenRepository;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use Nord\Lumen\OAuth2\Doctrine\Entities\Session;

class AccessTokenStorage extends DoctrineStorage implements AccessTokenInterface
{

    /**
     * @var AccessTokenRepository
     */
    protected $repository;

    /**
     * @var SessionRepository
     */
    protected $sessionRepository;


    /**
     * AccessTokenStorage constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository        = $this->entityManager->getRepository(AccessToken::class);
        $this->sessionRepository = $this->entityManager->getRepository(Session::class);
    }


    /**
     * @inheritdoc
     */
    public function get($token)
    {
        $accessToken = $this->repository->findByToken($token);

        if ($accessToken === null) {
            throw new AccessTokenNotFound;
        }

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
        /** @var Session $session */
        $session = $this->sessionRepository->find($sessionId);

        $accessToken = new AccessToken($token, $session, new Date($expireTime));

        $this->entityManager->persist($accessToken);
        $this->entityManager->flush($accessToken);
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
        $accessToken = $this->repository->findByToken($token->getId());

        if ($accessToken === null) {
            throw new AccessTokenNotFound;
        }

        $this->entityManager->remove($accessToken);
        $this->entityManager->flush($accessToken);
    }


    /**
     * @param AccessToken $accessToken
     *
     * @return AccessTokenEntity
     */
    protected function createEntity(AccessToken $accessToken)
    {
        $entity = new AccessTokenEntity($this->server);

        $entity->setId($accessToken->getToken());
        $entity->setExpireTime($accessToken->getExpireTime()->getTimestamp());

        return $entity;
    }
}
