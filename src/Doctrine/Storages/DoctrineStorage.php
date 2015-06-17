<?php namespace Nord\Lumen\OAuth2\Doctrine\Storages;

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
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
