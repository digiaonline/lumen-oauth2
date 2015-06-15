<?php namespace Nord\Lumen\OAuth2\Doctrine\Storage;

use Nord\Lumen\OAuth2\Doctrine\Repositories\ClientRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\Client;
use Nord\Lumen\OAuth2\Doctrine\Entities\Session;
use Nord\Lumen\OAuth2\Doctrine\Repositories\SessionRepository;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\SessionInterface;

class SessionStorage extends DoctrineStorage implements SessionInterface
{

    /**
     * @var SessionRepository
     */
    protected $repository;

    /**
     * @var ClientRepository
     */
    protected $clientRepository;


    /**
     * SessionStorage constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        $this->repository       = $this->entityManager->getRepository(Session::class);
        $this->clientRepository = $this->entityManager->getRepository(Client::class);
    }


    /**
     * @inheritdoc
     */
    public function getByAccessToken(AccessTokenEntity $accessToken)
    {
        $session = $this->repository->findByAccessToken($accessToken->getId());

        if ($session === null) {
            return null;
        }

        return $this->createEntity($session);
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
    }


    /**
     * @inheritdoc
     */
    public function create($ownerType, $ownerId, $clientId, $clientRedirectUri = null)
    {
        /** @var Client $client */
        $client = $this->clientRepository->findByKey($clientId);

        // TODO: support redirect URI
        $session = new Session($ownerType, $ownerId, $client);

        $this->entityManager->persist($session);
        $this->entityManager->flush($session);

        return $session->getId();
    }


    /**
     * @inheritdoc
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

        $entity->setId($session->getId());
        $entity->setOwner($session->getOwnerType(), $session->getOwnerId());

        return $entity;
    }
}
