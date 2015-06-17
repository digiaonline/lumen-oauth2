<?php namespace Nord\Lumen\OAuth2\Middleware;

use Nord\Lumen\OAuth2\OAuth2Service;
use Illuminate\Http\JsonResponse;
use League\OAuth2\Server\Exception\OAuthException;

class OAuth2Middleware
{

    /**
     * @var OAuth2Service
     */
    protected $service;


    /**
     * OAuth2Middleware constructor.
     *
     * @param OAuth2Service $service
     */
    public function __construct(OAuth2Service $service)
    {
        $this->service = $service;
    }


    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        try {
            $this->service->validateAccessToken();

            return $next($request);
        } catch (OAuthException $e) {
            // TODO: Support other response types
            return new JsonResponse(['message' => 'Access denied'], 401);
        }
    }
}
