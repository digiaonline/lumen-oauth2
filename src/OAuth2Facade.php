<?php

namespace Nord\Lumen\OAuth2;

use Illuminate\Support\Facades\Facade;

class OAuth2Facade extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return OAuth2Service::class;
    }
}
