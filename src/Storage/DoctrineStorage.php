<?php namespace Nord\Lumen\OAuth2\Storage;

use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Storage\AbstractStorage;

abstract class DoctrineStorage extends AbstractStorage
{

	/**
	 * @var EntityManager
	 */
	protected $entityManager;


	/**
	 * DoctrineStorage constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}
}
