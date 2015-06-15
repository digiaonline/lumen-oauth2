<?php namespace Nord\Lumen\OAuth2\Contracts;

interface OAuth2Service
{

    /**
     * @return array
     * @throws \League\OAuth2\Server\Exception\InvalidRequestException
     * @throws \League\OAuth2\Server\Exception\UnsupportedGrantTypeException
     */
    public function issueAccessToken();


    /**
     * @param bool        $headersOnly
     * @param null|string $accessToken
     *
     * @return bool
     * @throws \League\OAuth2\Server\Exception\AccessDeniedException
     */
    public function validateAccessToken($headersOnly = true, $accessToken = null);


    /**
     * @return string
     */
    public function getResourceOwnerId();


    /**
     * @return string
     */
    public function getResourceOwnerType();


    /**
     * @return string
     */
    public function getClientId();

}
