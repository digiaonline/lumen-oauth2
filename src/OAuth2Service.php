<?php namespace Nord\Lumen\OAuth2;

use League\OAuth2\Server\Grant\AuthCodeGrant;
use Nord\Lumen\OAuth2\Contracts\OAuth2Service as OAuth2ServiceContract;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\ResourceServer;

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
        $this->resourceServer      = $resourceServer;
    }


    /**
     * @return array
     * @throws \League\OAuth2\Server\Exception\InvalidRequestException
     * @throws \League\OAuth2\Server\Exception\UnsupportedGrantTypeException
     */
    public function issueAccessToken()
    {
        return $this->authorizationServer->issueAccessToken();
    }


    /**
     * @param bool        $headersOnly
     * @param null|string $accessToken
     *
     * @return bool
     * @throws \League\OAuth2\Server\Exception\AccessDeniedException
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
        // TODO: Calling validateAccessToken is kind of a hack, but it is necessary in order to load the access token.
        $this->validateAccessToken();

        return $this->resourceServer->getAccessToken()->getSession()->getOwnerType();
    }


    /**
     * @return string
     */
    public function getClientId()
    {
        // TODO: Calling validateAccessToken is kind of a hack, but it is necessary in order to load the access token.
        $this->validateAccessToken();

        return $this->resourceServer->getAccessToken()->getSession()->getClient()->getId();
    }

    /**
     * Check authorize parameters
     *
     * @return array Authorize request parameters
     * @throws \League\OAuth2\Server\Exception\InvalidRequestException
     * @throws \League\OAuth2\Server\Exception\InvalidClientException
     * @throws \League\OAuth2\Server\Exception\UnsupportedResponseTypeException
     */
    public function checkAuthorizeParams()
    {
        if ($this->authorizationServer->hasGrantType('authorization_code')) {
            /** @var AuthCodeGrant $authGrant */
            $authGrant = $this->authorizationServer->getGrantType('authorization_code');
            return $authGrant->checkAuthorizeParams();
        }

        return [];
    }

    /**
     * Parse a new authorize request
     *
     * @param string $type The session owner's type
     * @param string $typeId The session owner's ID
     * @param array $authParams The authorize request $_GET parameters
     *
     * @return string
     */
    public function newAuthorizeRequest($type, $typeId, $authParams = [])
    {
        if ($this->authorizationServer->hasGrantType('authorization_code')) {
            /** @var AuthCodeGrant $authGrant */
            $authGrant = $this->authorizationServer->getGrantType('authorization_code');
            return $authGrant->newAuthorizeRequest($type, $typeId, $authParams);
        }

        return '';
    }
}
