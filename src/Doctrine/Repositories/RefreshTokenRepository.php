<?php namespace Nord\Lumen\OAuth2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Nord\Lumen\OAuth2\Doctrine\Entities\RefreshToken;

class RefreshTokenRepository extends EntityRepository
{

    /**
     * @param string $token
     *
     * @return null|RefreshToken
     */
    public function findByToken($token)
    {
        return $this->createQueryBuilder('rt')
            ->where('rt.token = :token AND rt.expireTime >= :now')
            ->setParameters(['token' => $token, 'now' => time()])
            ->getQuery()
            ->getOneOrNullResult();
    }
}
