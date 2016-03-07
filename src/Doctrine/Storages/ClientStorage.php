<?php namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Nord\Lumen\OAuth2\Exceptions\ClientNotFound;
use Nord\Lumen\OAuth2\Doctrine\Repositories\SessionRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\Client;
use Nord\Lumen\OAuth2\Doctrine\Repositories\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entity\ClientEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\ClientInterface;
use Nord\Lumen\OAuth2\Doctrine\Entities\Session;

class ClientStorage extends DoctrineStorage implements ClientInterface
{

    /**
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * @var SessionRepository
     */
    protected $sessionRepository;


    /**
     * ClientStorage constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->clientRepository  = $this->entityManager->getRepository(Client::class);
        $this->sessionRepository = $this->entityManager->getRepository(Session::class);
    }


    /**
     * @inheritdoc
     */
    public function get($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
    {
        /** @var Client $client */
        $client = $this->clientRepository->findByKey($clientId);

        if ($client === null) {
            throw new ClientNotFound;
        }

        return $this->createEntity($client);
    }


    /**
     * @inheritdoc
     */
    public function getBySession(SessionEntity $entity)
    {
        /** @var Session $session */
        $session = $this->sessionRepository->find($entity->getId());

        $client = $this->clientRepository->findBySession($session);

        if ($client === null) {
            throw new ClientNotFound;
        }

        return $this->createEntity($client);
    }


    /**
     * @param Client $client
     *
     * @return \League\OAuth2\Server\Entity\ClientEntity
     */
    protected function createEntity(Client $client)
    {
        $entity = new ClientEntity($this->server);

        $entity->hydrate([
            'id'   => $client->getKey(),
            'name' => $client->getName(),
        ]);

        return $entity;
    }
}
