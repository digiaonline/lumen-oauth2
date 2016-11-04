<?php

namespace Nord\Lumen\OAuth2\Doctrine\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Nord\Lumen\OAuth2\Doctrine\Repositories\AccessTokenRepository")
 * @ORM\Table(name="oauth_access_tokens")
 */
class AccessToken extends Entity
{
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $token;

    /**
     * @ORM\ManyToOne(targetEntity="Nord\Lumen\OAuth2\Doctrine\Entities\Session")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var Session
     */
    protected $session;

    /**
     * @ORM\Column(type="datetime", name="expire_time")
     *
     * @var Carbon
     */
    protected $expireTime;

    /**
     * AccessToken constructor.
     *
     * @param string  $token
     * @param Session $session
     * @param Carbon  $expireTime
     */
    public function __construct($token, Session $session, Carbon $expireTime)
    {
        $this->token = $token;
        $this->session = $session;
        $this->expireTime = $expireTime;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return Carbon
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }
}
