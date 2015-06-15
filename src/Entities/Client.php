<?php namespace Nord\Lumen\OAuth2\Entities;

class Client
{

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $secret;

	/**
	 * @var string
	 */
	protected $name;


	/**
	 * @return string
	 */
	public function id()
	{
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function secret()
	{
		return $this->secret;
	}


	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}
}
