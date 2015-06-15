<?php namespace Nord\Lumen\OAuth2\Repositories;

use Nord\Lumen\OAuth2\Entities\Client;
use Nord\Lumen\OAuth2\Entities\Session;
use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{

	/**
	 * @param string $id
	 *
	 * @return null|Client
	 */
	public function findById($id)
	{
		return $this->findOneBy([ 'id' => $id ]);
	}


	/**
	 * @param $sessionId
	 *
	 * @return Client|null
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function findBySessionId($sessionId)
	{
		return $this->createQueryBuilder('c')
			->innerJoin(Session::class, 'at', 'WITH', 's.clientId = c.id')
			->where('s.id = :session_id')
			->setParameter('session_id', $sessionId)
			->groupBy('c.id')
			->getQuery()
			->getOneOrNullResult();
	}
}
