<?php

namespace Nord\Lumen\OAuth2\Tests;

use Nord\Lumen\OAuth2\OAuth2Service;

class OAuth2ServiceTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @inheritdoc
     */
    protected function setup()
    {
        \Helper\Unit::setAuthorizationHeader();
    }

    /**
     *
     */
    public function testAssertIssueAccessToken()
    {
        $this->specify('verify service issueAccessToken', function () {
            $service = $this->createService();
            verify($service->issueAccessToken())->equals(MockAccessToken::toArray());
        });
    }

    /**
     *
     */
    public function testAssertValidateAccessToken()
    {
        $this->specify('verify service validateAccessToken', function () {
            $service = $this->createService();
            verify($this->validateAccessToken($service))->true();
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerId()
    {
        $this->specify('verify service can getResourceOwnerId', function () {
            $service = $this->createService();
            $this->validateAccessToken($service);
            verify($service->getResourceOwnerId())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerType()
    {
        $this->specify('verify service can getResourceOwnerType', function () {
            $service = $this->createService();
            $this->validateAccessToken($service);
            verify($service->getResourceOwnerType())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetClientId()
    {
        $this->specify('verify service can getClientId', function () {
            $service = $this->createService();
            $this->validateAccessToken($service);
            verify($service->getClientId())->equals('test');
        });
    }

    /**
     * @param OAuth2Service $service
     * @return bool
     */
    private function validateAccessToken($service)
    {
        return $service->validateAccessToken(true, MockAccessToken::$accessToken);
    }

    /**
     * @return OAuth2Service
     */
    private function createService()
    {
        return new OAuth2Service($this->createAuthorizationServer(), $this->createResourceServer());
    }

    /**
     * @return MockAuthorizationServer
     */
    private function createAuthorizationServer()
    {
        return new MockAuthorizationServer();
    }

    /**
     * @return \League\OAuth2\Server\ResourceServer
     */
    private function createResourceServer()
    {
        return new \League\OAuth2\Server\ResourceServer(
            new MockSessionStorage(),
            new MockAccessTokenStorage(),
            new MockClientStorage(),
            new MockScopeStorage()
        );
    }
}
