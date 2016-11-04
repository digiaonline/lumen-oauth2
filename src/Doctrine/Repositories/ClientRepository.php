<?php

namespace Nord\Lumen\OAuth2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\Client;
use Nord\Lumen\OAuth2\Doctrine\Entities\Session;

class ClientRepository extends EntityRepository
{
    /**
     * @param string $key
     *
     * @return Client|null
     */
    public function findByKey($key)
    {
        return $this->findOneBy(['key' => $key]);
    }

    /**
     * @param $sessionId
     *
     * @return Client|null
     */
    public function findBySession(Session $session)
    {
        return $this->findOneBy(['session' => $session]);
    }
}
