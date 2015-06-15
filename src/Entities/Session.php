<?php namespace Nord\Lumen\OAuth2\Entities;

class Session
{

	const OWNER_TYPE_USER = 'user';
	const OWNER_TYPE_CLIENT = 'client';

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $ownerType = self::OWNER_TYPE_USER;

	/**
	 * @var string
	 */
	protected $ownerId;

	/**
	 * @var string
	 */
	protected $clientId;

	/**
	 * @var string
	 */
	protected $clientRedirectUri;


	/**
	 * Session constructor.
	 *
	 * @param string $anOwnerType
	 * @param string $anOwnerId
	 * @param string $aClientId
	 */
	public function __construct($anOwnerType, $anOwnerId, $aClientId)
	{
		$this->ownerType = $anOwnerType;
		$this->ownerId   = $anOwnerId;
		$this->clientId  = $aClientId;
	}


	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function ownerType()
	{
		return $this->ownerType;
	}


	/**
	 * @return string
	 */
	public function ownerId()
	{
		return $this->ownerId;
	}
}
