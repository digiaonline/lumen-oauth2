<?php

namespace Nord\Lumen\OAuth2\Tests;

use Nord\Lumen\OAuth2\OAuth2Service;

class OAuth2ServiceTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var array
     */
    protected static $token = [
        'access_token'  => 'mF_9.B5f-4.1JqM',
        'token_type'    => 'Bearer',
        'expires_in'    => 3600,
        'refresh_token' => 'tGzv3JOkF0XG5Qx2TlKWIA'
    ];

    /**
     * @inheritdoc
     */
    protected function setup()
    {
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer mF_9.B5f-4.1JqM';
    }

    /**
     *
     */
    public function testAssertIssueAccessToken()
    {
        $this->specify('verify service issueAccessToken', function () {
            $authorizationServer = $this->createAuthorizationServer();
            $authorizationServer->expects($this->once())
               ->method('issueAccessToken')
               ->will($this->returnValue(self::$token));

            $service = new OAuth2Service($authorizationServer, $this->createResourceServer());
            verify($service->issueAccessToken())->equals(self::$token);
        });
    }

    /**
     *
     */
    public function testAssertValidateAccessToken()
    {
        $this->specify('verify service validateAccessToken', function () {
            $service = new OAuth2Service($this->createAuthorizationServer(), $this->createResourceServer());
            verify($service->validateAccessToken(true, self::$token['access_token']))->true();
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerId()
    {
        $this->specify('verify service can getResourceOwnerId', function () {
            $service = new OAuth2Service($this->createAuthorizationServer(), $this->createResourceServer());
            $service->validateAccessToken(true, self::$token['access_token']);
            verify($service->getResourceOwnerId())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerType()
    {
        $this->specify('verify service can getResourceOwnerType', function () {
            $service = new OAuth2Service($this->createAuthorizationServer(), $this->createResourceServer());
            $service->validateAccessToken(true, self::$token['access_token']);
            verify($service->getResourceOwnerType())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetClientId()
    {
        $this->specify('verify service can getClientId', function () {
            $service = new OAuth2Service($this->createAuthorizationServer(), $this->createResourceServer());
            $service->validateAccessToken(true, self::$token['access_token']);
            verify($service->getClientId())->equals('test');
        });
    }

    /**
     * @return \League\OAuth2\Server\AuthorizationServer|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createAuthorizationServer()
    {
        $authorizationServer = $this->getMockBuilder(\League\OAuth2\Server\AuthorizationServer::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $authorizationServer;
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
