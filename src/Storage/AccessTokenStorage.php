<?php namespace Nord\Lumen\OAuth2\Storage;

use Nord\Lumen\OAuth2\Entities\AccessToken;
use Nord\Lumen\OAuth2\Repositories\AccessTokenRepository;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\AccessTokenInterface;

class AccessTokenStorage extends DoctrineStorage implements AccessTokenInterface
{

	/**
	 * @var AccessTokenRepository
	 */
	protected $repository;


	/**
	 * AccessTokenStorage constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $anEntityManager
	 */
	public function __construct(EntityManager $anEntityManager)
	{
		parent::__construct($anEntityManager);

		$this->repository = $this->entityManager->getRepository(AccessToken::class);
	}


	/**
	 * @inheritdoc
	 */
	public function get($token)
	{
		$accessToken = $this->repository->findByToken($token);

		if ($accessToken === null) {
			return null;
		}

		$entity = new AccessTokenEntity($this->server);

		$entity->setId($accessToken->accessToken())
			->setExpireTime($accessToken->expireTime());

		return $entity;
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
		$accessToken = new AccessToken($token, $sessionId, $expireTime);

		$this->entityManager->persist($accessToken);
		$this->entityManager->flush();
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
			return;
		}

		$this->entityManager->remove($accessToken);
		$this->entityManager->flush();
	}
}
