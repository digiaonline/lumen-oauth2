<?php

namespace Nord\Lumen\OAuth2\Middleware;

use League\OAuth2\Server\Exception\OAuthException;
use Nord\Lumen\Core\Traits\CreatesHttpResponses;
use Nord\Lumen\OAuth2\Traits\AuthenticatesUsers;

class OAuth2Middleware
{
    use AuthenticatesUsers;
    use CreatesHttpResponses;

    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        try {
            $this->getOAuth2Service()->validateAccessToken();

            return $next($request);
        } catch (OAuthException $e) {
            return $this->accessDeniedResponse('ERROR.ACCESS_DENIED');
        }
    }
}
