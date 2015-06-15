<?php namespace Nord\Lumen\OAuth2;

use Illuminate\Support\Facades\Facade;

class OAuth2ServiceFacade extends Facade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'Nord\Lumen\OAuth2\OAuth2ServiceFacade';
    }
}
