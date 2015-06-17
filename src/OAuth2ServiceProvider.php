<?php namespace Nord\Lumen\OAuth2;

use Exception;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\Storage\RefreshTokenInterface;
use Nord\Lumen\OAuth2\Contracts\OAuth2Adapter as OAuth2AdapterContract;
use Nord\Lumen\OAuth2\Contracts\OAuth2Service as OAuth2ServiceContract;
use Nord\Lumen\OAuth2\Facades\OAuth2Service as OAuthServiceFacade;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\ScopeInterface;
use League\OAuth2\Server\Storage\SessionInterface;

class OAuth2ServiceProvider extends ServiceProvider
{

    const ADAPTER_ELOQUENT = 'Nord\Lumen\OAuth2\Eloquent\EloquentAdapter';
    const ADAPTER_DOCTRINE = 'Nord\Lumen\OAuth2\Doctrine\DoctrineAdapter';


    /**
     * @inheritdoc
     */
    public function register()
    {
        $config = $this->app['config']['oauth2'];

        $this->app->alias(OAuth2Service::class, OAuth2ServiceContract::class);

        $this->app->bind(OAuth2Service::class, function () use ($config) {
            return $this->createService($config);
        });

        class_alias(OAuthServiceFacade::class, 'OAuth2');
    }


    /**
     * @param array $config
     *
     * @return OAuth2Service
     */
    protected function createService(array $config)
    {
        $adapterClass = array_get($config, 'adapter', self::ADAPTER_ELOQUENT);

        /** @var OAuth2AdapterContract $adapter */
        $adapter = new $adapterClass();

        $authorizationServer = $this->createAuthorizationServer(
            $config,
            $adapter->getSessionStorage(),
            $adapter->getAccessTokenStorage(),
            $adapter->getRefreshTokenStorage(),
            $adapter->getClientStorage(),
            $adapter->getScopeStorage()
        );

        $resourceServer = $this->createResourceServer(
            $adapter->getSessionStorage(),
            $adapter->getAccessTokenStorage(),
            $adapter->getClientStorage(),
            $adapter->getScopeStorage()
        );

        return new OAuth2Service($authorizationServer, $resourceServer);
    }


    /**
     * @param array                 $config
     * @param SessionInterface      $sessionStorage
     * @param AccessTokenInterface  $accessTokenStorage
     * @param RefreshTokenInterface $refreshTokenStorage
     * @param ClientInterface       $clientStorage
     * @param ScopeInterface        $scopeStorage
     *
     * @return AuthorizationServer
     * @throws Exception
     */
    protected function createAuthorizationServer(
        array $config,
        SessionInterface $sessionStorage,
        AccessTokenInterface $accessTokenStorage,
        RefreshTokenInterface $refreshTokenStorage,
        ClientInterface $clientStorage,
        ScopeInterface $scopeStorage
    ) {
        // TODO: Support scopes
        $authorizationServer = new AuthorizationServer();
        $authorizationServer->setSessionStorage($sessionStorage);
        $authorizationServer->setAccessTokenStorage($accessTokenStorage);
        $authorizationServer->setRefreshTokenStorage($refreshTokenStorage);
        $authorizationServer->setClientStorage($clientStorage);
        $authorizationServer->setScopeStorage($scopeStorage);

        if (isset($config['scope_param'])) {
            $authorizationServer->requireScopeParam($config['scope_param']);
        }
        if (isset($config['default_scope'])) {
            $authorizationServer->setDefaultScope($config['default_scope']);
        }
        if (isset($config['state_param'])) {
            $authorizationServer->requireStateParam($config['state_param']);
        }
        if (isset($config['scope_delimiter'])) {
            $authorizationServer->setScopeDelimiter($config['scope_delimiter']);
        }
        if (isset($config['access_token_ttl'])) {
            $authorizationServer->setAccessTokenTTL($config['access_token_ttl']);
        }

        // TODO: Support configuring of the remaining grant types
        foreach ($config['grant_types'] as $name => $params) {
            if (!isset($params['class'])) {
                throw new Exception("Parameter 'class' must be set for grant type.");
            }

            /** @var AbstractGrant $grantType */
            $grantType = new $params['class'];

            if (isset($params['access_token_ttl'])) {
                $grantType->setAccessTokenTTL($params['access_token_ttl']);
            }

            if ($grantType instanceof PasswordGrant) {
                /** @var PasswordGrant $grantType */
                if (isset($params['callback'])) {
                    $grantType->setVerifyCredentialsCallback($params['callback']);
                }
            }

            if ($grantType instanceof RefreshTokenGrant) {
                /** @var RefreshTokenGrant $grantType */
                if (isset($params['refresh_token_rotate'])) {
                    $grantType->setRefreshTokenRotation($params['refresh_token_rotate']);
                }
                if (isset($params['refresh_token_ttl'])) {
                    $grantType->setRefreshTokenTTL($params['refresh_token_ttl']);
                }
            }

            $authorizationServer->addGrantType($grantType);
        }

        return $authorizationServer;
    }


    /**
     * @param SessionInterface     $sessionStorage
     * @param AccessTokenInterface $accessTokenStorage
     * @param ClientInterface      $clientStorage
     * @param ScopeInterface       $scopeStorage
     *
     * @return ResourceServer
     */
    protected function createResourceServer(
        SessionInterface $sessionStorage,
        AccessTokenInterface $accessTokenStorage,
        ClientInterface $clientStorage,
        ScopeInterface $scopeStorage
    ) {
        return new ResourceServer($sessionStorage, $accessTokenStorage, $clientStorage, $scopeStorage);
    }
}
