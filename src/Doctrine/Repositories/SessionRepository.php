<?php

namespace Nord\Lumen\OAuth2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken;
use Nord\Lumen\OAuth2\Doctrine\Entities\Session;

class SessionRepository extends EntityRepository
{
    /**
     * @param string $accessToken
     *
     * @return Session|null
     */
    public function findByAccessToken($accessToken)
    {
        return $this->createQueryBuilder('s')
            ->innerJoin(AccessToken::class, 'at', Join::WITH, 's.id = at.session')
            ->where('at.token = :access_token')
            ->setParameter('access_token', $accessToken)
            ->groupBy('s.id')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
