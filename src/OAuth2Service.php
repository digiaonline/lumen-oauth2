<?php

namespace Nord\Lumen\OAuth2;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\ResourceServer;
use Nord\Lumen\OAuth2\Contracts\OAuth2Service as OAuth2ServiceContract;

class OAuth2Service implements OAuth2ServiceContract
{
    /**
     * @var AuthorizationServer
     */
    private $authorizationServer;

    /**
     * @var ResourceServer
     */
    private $resourceServer;

    /**
     * OAuth2Server constructor.
     *
     * @param AuthorizationServer $authorizationServer
     * @param ResourceServer      $resourceServer
     */
    public function __construct(AuthorizationServer $authorizationServer, ResourceServer $resourceServer)
    {
        $this->authorizationServer = $authorizationServer;
        $this->resourceServer = $resourceServer;
    }

    /**
     * @throws \League\OAuth2\Server\Exception\InvalidRequestException
     * @throws \League\OAuth2\Server\Exception\UnsupportedGrantTypeException
     *
     * @return array
     */
    public function issueAccessToken()
    {
        return $this->authorizationServer->issueAccessToken();
    }

    /**
     * @param bool        $headersOnly
     * @param null|string $accessToken
     *
     * @throws \League\OAuth2\Server\Exception\AccessDeniedException
     *
     * @return bool
     */
    public function validateAccessToken($headersOnly = true, $accessToken = null)
    {
        return $this->resourceServer->isValidRequest($headersOnly, $accessToken);
    }

    /**
     * @return string
     */
    public function getResourceOwnerId()
    {
        // TODO: Calling validateAccessToken is kind of a hack, but it is necessary in order to load the access token.
        $this->validateAccessToken();

        return $this->resourceServer->getAccessToken()->getSession()->getOwnerId();
    }

    /**
     * @return string
     */
    public function getResourceOwnerType()
    {
        return $this->resourceServer->getAccessToken()->getSession()->getOwnerType();
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->resourceServer->getAccessToken()->getSession()->getClient()->getId();
    }
}
