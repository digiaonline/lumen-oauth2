<?php

namespace Nord\Lumen\OAuth2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken;

class AccessTokenRepository extends EntityRepository
{
    /**
     * @param string $token
     *
     * @return null|AccessToken
     */
    public function findByToken($token)
    {
        return $this->findOneBy(['token' => $token]);
    }
}
