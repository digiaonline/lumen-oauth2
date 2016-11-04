<?php

namespace Nord\Lumen\OAuth2\Doctrine\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Nord\Lumen\OAuth2\Doctrine\Repositories\RefreshTokenRepository")
 * @ORM\Table(name="oauth_refresh_tokens")
 */
class RefreshToken extends Entity
{
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $token;

    /**
     * @ORM\ManyToOne(targetEntity="Nord\Lumen\OAuth2\Doctrine\Entities\AccessToken")
     * @ORM\JoinColumn(name="access_token_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="datetime", name="expire_time")
     *
     * @var Carbon
     */
    protected $expireTime;

    /**
     * RefreshToken constructor.
     *
     * @param string      $token
     * @param AccessToken $accessToken
     * @param Carbon      $expireTime
     */
    public function __construct($token, AccessToken $accessToken, Carbon $expireTime)
    {
        $this->token = $token;
        $this->accessToken = $accessToken;
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
     * @return AccessToken
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return Carbon
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }
}
