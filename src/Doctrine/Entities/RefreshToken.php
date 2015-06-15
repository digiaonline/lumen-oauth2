<?php namespace Nord\Lumen\OAuth2\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;
use Jenssegers\Date\Date;

/**
 * @ORM\Entity(repositoryClass="Nord\Lumen\OAuth2\Doctrine\Repositories\RefreshTokenRepository")
 * @ORM\Table(name="oauth_refresh_tokens")
 */
class RefreshToken extends Entity
{

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $token;

    /**
     * @ORM\ManyToOne(targetEntity="Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken")
     * @ORM\JoinColumn(name="access_token_id", referencedColumnName="id", onDelete="CASCADE")
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="datetime", name="expire_time")
     * @var Date
     */
    protected $expireTime;


    /**
     * RefreshToken constructor.
     *
     * @param string      $token
     * @param AccessToken $accessToken
     * @param Date        $expireTime
     */
    public function __construct($token, AccessToken $accessToken, Date $expireTime)
    {
        $this->token       = $token;
        $this->accessToken = $accessToken;
        $this->expireTime  = $expireTime;
    }


    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * @return AccessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }


    /**
     * @return Date
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

}
