<?php

namespace Nord\Lumen\OAuth2\Contracts;

use League\OAuth2\Server\Exception\AccessDeniedException;
use League\OAuth2\Server\Exception\InvalidRequestException;
use League\OAuth2\Server\Exception\UnsupportedGrantTypeException;

interface OAuth2Service
{
    /**
     * @throws InvalidRequestException
     * @throws UnsupportedGrantTypeException
     *
     * @return array
     */
    public function issueAccessToken();

    /**
     * @param bool        $headersOnly
     * @param null|string $accessToken
     *
     * @throws AccessDeniedException
     *
     * @return bool
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
