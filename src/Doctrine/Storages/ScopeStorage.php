<?php

namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use Nord\Lumen\OAuth2\Doctrine\Repositories\ScopeRepository;

class ScopeStorage extends DoctrineStorage implements ScopeInterface
{
    /**
     * @var ScopeRepository
     */
    protected $repository;

    /**
     * ScopeStorage constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        //$this->repository = $this->entityManager->getRepository(Scope::class);
    }

    /**
     * {@inheritdoc}
     */
    public function get($scope, $grantType = null, $clientId = null)
    {
        throw new \Exception('Not implemented');
    }
}
