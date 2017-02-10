<?php

namespace Nord\Lumen\OAuth2\Tests;

use Helper\Unit;
use Nord\Lumen\OAuth2\OAuth2Service;

class OAuth2ServiceTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /**
     * @var OAuth2Service
     */
    private $service;

    /**
     * @inheritdoc
     */
    protected function setup()
    {
        Unit::setAuthorizationHeader();
        $this->service = new OAuth2Service(Unit::createAuthorizationServer(), Unit::createResourceServer());
    }

    /**
     *
     */
    public function testAssertIssueAccessToken()
    {
        $this->specify('verify service issueAccessToken', function () {
            verify($this->service->issueAccessToken())->equals(MockAccessToken::toArray());
        });
    }

    /**
     *
     */
    public function testAssertValidateAccessToken()
    {
        $this->specify('verify service validateAccessToken', function () {
            verify($this->service->validateAccessToken())->true();
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerId()
    {
        $this->specify('verify service can getResourceOwnerId', function () {
            $this->service->validateAccessToken();
            verify($this->service->getResourceOwnerId())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetResourceOwnerType()
    {
        $this->specify('verify service can getResourceOwnerType', function () {
            $this->service->validateAccessToken();
            verify($this->service->getResourceOwnerType())->equals('test');
        });
    }

    /**
     *
     */
    public function testAssertGetClientId()
    {
        $this->specify('verify service can getClientId', function () {
            $this->service->validateAccessToken();
            verify($this->service->getClientId())->equals('test');
        });
    }
}
