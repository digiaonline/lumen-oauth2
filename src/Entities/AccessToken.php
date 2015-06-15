<?php namespace Nord\Lumen\OAuth2\Entities;

class AccessToken
{

	/**
	 * @var string
	 */
	protected $accessToken;

	/**
	 * @var int
	 */
	protected $sessionId;

	/**
	 * @var int
	 */
	protected $expireTime;


	/**
	 * AccessToken constructor.
	 *
	 * @param string $accessToken
	 * @param int    $sessionId
	 * @param int    $expireTime
	 */
	public function __construct($accessToken, $sessionId, $expireTime)
	{
		$this->accessToken = $accessToken;
		$this->sessionId   = $sessionId;
		$this->expireTime  = $expireTime;
	}


	/**
	 * @return string
	 */
	public function accessToken()
	{
		return $this->accessToken;
	}


	/**
	 * @return int
	 */
	public function expireTime()
	{
		return $this->expireTime;
	}
}
