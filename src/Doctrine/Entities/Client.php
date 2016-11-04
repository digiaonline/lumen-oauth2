<?php

namespace Nord\Lumen\OAuth2\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Nord\Lumen\OAuth2\Doctrine\Repositories\ClientRepository")
 * @ORM\Table(name="oauth_clients")
 */
class Client extends Entity
{
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $key;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $secret;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * Client constructor.
     *
     * @param string $key
     * @param string $secret
     * @param string $name
     */
    public function __construct($key, $secret, $name)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
