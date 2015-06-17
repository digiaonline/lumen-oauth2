<?php namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Nord\Lumen\OAuth2\Doctrine\Repositories\ScopeRepository;
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
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);

        //$this->repository = $this->entityManager->getRepository(Scope::class);
    }


    /**
     * @inheritdoc
     */
    public function get($scope, $grantType = null, $clientId = null)
    {
        throw new \Exception('Not implemented');
    }
}
