<?php namespace Nord\Lumen\OAuth2\Repositories;

use Nord\Lumen\OAuth2\Entities\AccessToken;
use Doctrine\ORM\EntityRepository;

class AccessTokenRepository extends EntityRepository
{

	/**
	 * @param string $token
	 *
	 * @return null|AccessToken
	 */
	public function findByToken($token)
	{
		return $this->findOneBy([ 'accessToken' => $token ]);
	}
}
