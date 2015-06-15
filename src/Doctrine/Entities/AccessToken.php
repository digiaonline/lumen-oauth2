<?php namespace Nord\Lumen\OAuth2\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;
use Jenssegers\Date\Date;

/**
 * @ORM\Entity(repositoryClass="Nord\Lumen\OAuth2\Doctrine\Repositories\AccessTokenRepository")
 * @ORM\Table(name="oauth_access_tokens")
 */
class AccessToken extends Entity
{

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $token;

    /**
     * @ORM\ManyToOne(targetEntity="Nord\Lumen\OAuth2\Doctrine\Entities\Session")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Session
     */
    protected $session;

    /**
     * @ORM\Column(type="datetime", name="expire_time")
     * @var Date
     */
    protected $expireTime;


    /**
     * AccessToken constructor.
     *
     * @param string  $token
     * @param Session $session
     * @param Date    $expireTime
     */
    public function __construct($token, Session $session, Date $expireTime)
    {
        $this->token      = $token;
        $this->session    = $session;
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
     * @return Date
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }
}
