<?php

namespace Nord\Lumen\OAuth2\Doctrine\Storages;

use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Storage\AbstractStorage;

abstract class DoctrineStorage extends AbstractStorage
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * DoctrineStorage constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
