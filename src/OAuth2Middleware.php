<?php

namespace Nord\Lumen\OAuth2;

use Closure;
use Illuminate\Http\Request;
use Nord\Lumen\Core\App\AuthenticatesUsers;
use Nord\Lumen\Core\App\CreatesHttpResponses;
use League\OAuth2\Server\Exception\OAuthException;

class OAuth2Middleware
{

    use AuthenticatesUsers;
    use CreatesHttpResponses;


    /**
     * Run the request filter.
     *
     * @param  Request $request
     * @param  Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->getOAuth2Service()->validateAccessToken();

            return $next($request);
        } catch (OAuthException $e) {
            return $this->accessDeniedResponse('ERROR.ACCESS_DENIED');
        }
    }
}
