<?php namespace Nord\Lumen\OAuth2\Facades;

use Illuminate\Support\Facades\Facade;

class OAuth2Service extends Facade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'Nord\Lumen\OAuth2\Facades\OAuth2Service';
    }
}
