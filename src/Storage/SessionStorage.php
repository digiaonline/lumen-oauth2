<?php namespace Nord\Lumen\OAuth2\Storage;

use Nord\Lumen\OAuth2\Entities\Session;
use Nord\Lumen\OAuth2\Repositories\SessionRepository;
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
	 * SessionStorage constructor.
	 *
	 * @param EntityManager $anEntityManager
	 */
	public function __construct(EntityManager $anEntityManager)
	{
		parent::__construct($anEntityManager);

		$this->repository = $this->entityManager->getRepository(Session::class);
	}


	/**
	 * @inheritdoc
	 */
	public function getByAccessToken(AccessTokenEntity $accessToken)
	{
		$session = $this->repository->findByAccessTokenId($accessToken->getId());

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
		// TODO: support redirect URI
		$session = new Session($ownerType, $ownerId, $clientId);

		$this->entityManager->persist($session);
		$this->entityManager->flush();

		return $session->id();
	}


	/**
	 * @inheritdoc
	 */
	public function associateScope(SessionEntity $session, ScopeEntity $scope)
	{
		throw new \Exception('Not implemented');
	}


	/**
	 * @param \Nord\Lumen\OAuth2\Entities\Session $session
	 *
	 * @return \League\OAuth2\Server\Entity\SessionEntity
	 */
	protected function createEntity(Session $session)
	{
		$entity = new SessionEntity($this->server);

		$entity->setId($session->id());
		$entity->setOwner($session->ownerType(), $session->ownerId());

		return $entity;
	}
}
