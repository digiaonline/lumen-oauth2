<?php namespace Nord\Lumen\OAuth2\Storage;

use Nord\Lumen\OAuth2\Entities\Client;
use Nord\Lumen\OAuth2\Repositories\ClientRepository;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entity\ClientEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\ClientInterface;

class ClientStorage extends DoctrineStorage implements ClientInterface
{

	/**
	 * @var ClientRepository
	 */
	protected $repository;


	/**
	 * ClientStorage constructor.
	 *
	 * @param EntityManager $anEntityManager
	 */
	public function __construct(EntityManager $anEntityManager)
	{
		parent::__construct($anEntityManager);

		$this->repository = $this->entityManager->getRepository(Client::class);
	}


	/**
	 * @inheritdoc
	 */
	public function get($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
	{
		$client = $this->repository->findById($clientId);

		if ($client === null) {
			return null;
		}

		return $this->createEntity($client);
	}


	/**
	 * @inheritdoc
	 */
	public function getBySession(SessionEntity $session)
	{
		$client = $this->repository->findBySessionId($session->getId());

		if ($client === null) {
			return null;
		}

		return $this->createEntity($client);
	}


	/**
	 * @param \Nord\Lumen\OAuth2\Entities\Client $client
	 *
	 * @return \League\OAuth2\Server\Entity\ClientEntity
	 */
	protected function createEntity(Client $client)
	{
		$entity = new ClientEntity($this->server);

		$entity->hydrate([
			'id'   => $client->id(),
			'name' => $client->name(),
		]);

		return $entity;
	}
}
