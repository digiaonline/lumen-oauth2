<?php

namespace Nord\Lumen\OAuth2\Traits;

use Nord\Lumen\OAuth2\Contracts\OAuth2Service;

trait AuthenticatesUsers
{
    /**
     * @return OAuth2Service
     */
    private function getOAuth2Service()
    {
        return app(OAuth2Service::class);
    }
}
