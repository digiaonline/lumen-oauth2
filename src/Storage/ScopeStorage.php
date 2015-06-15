<?php namespace Nord\Lumen\OAuth2\Storage;

use Nord\Lumen\OAuth2\Repositories\ScopeRepository;
use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Storage\ScopeInterface;

class ScopeStorage extends DoctrineStorage implements ScopeInterface
{

	/**
	 * @var ScopeRepository
	 */
	protected $repository;


	/**
	 * ScopeStorage constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $anEntityManager
	 */
	public function __construct(EntityManager $anEntityManager)
	{
		parent::__construct($anEntityManager);

		//$this->repository = $this->entityManager->getRepository()
	}


	/**
	 * @inheritdoc
	 */
	public function get($scope, $grantType = null, $clientId = null)
	{
		throw new \Exception('Not implemented');
	}
}
