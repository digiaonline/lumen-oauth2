<?php namespace Nord\Lumen\OAuth2\Repositories;

use Nord\Lumen\OAuth2\Entities\AccessToken;
use Nord\Lumen\OAuth2\Entities\Session;
use Doctrine\ORM\EntityRepository;

class SessionRepository extends EntityRepository
{

	/**
	 * @param string $accessTokenId
	 *
	 * @return null|Session
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function findByAccessTokenId($accessTokenId)
	{
		return $this->createQueryBuilder('s')
			->innerJoin(AccessToken::class, 'at', 'WITH', 'at.sessionId = s.id')
			->where('at.accessToken = :access_token')
			->setParameter('access_token', $accessTokenId)
			->groupBy('s.id')
			->getQuery()
			->getOneOrNullResult();
	}
}
