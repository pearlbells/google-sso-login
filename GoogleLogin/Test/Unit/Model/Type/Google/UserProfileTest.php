<?php

namespace BA\GoogleLogin\Test\Unit\Model\Type\Google;

use BA\GoogleLogin\Model\Type\Google\UserProfile;
use PHPUnit\Framework\TestCase;
use BA\GoogleLogin\Model\Data\LoginData;


class UserProfileTest extends TestCase
{
    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Google\GetGoogleClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $getGoogleClientMock;

    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleServiceOauthFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $googleServiceMock;

    /**
     * @var \BA\GoogleLogin\Model\Type\Google\UserProfile
     */
    protected $userProfileObject;

    /**
     * @var \Magento\Framework\ObjectManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectManagerMock;

    /**
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    public function setUp(): void
    {
        $this->objectManagerMock = $this->createMock(\Magento\Framework\ObjectManagerInterface::class);
        $this->clientMock = $this->createMock(\BA\GoogleLogin\Model\Type\Google\GoogleClient::class);

        $this->userProfileData = new UserProfile(
            $this->clientMock,
            $this->objectManagerMock
        );
    }

    public function testGetLoginDataResponseReturnNull()
    {
        $this->clientMock->method('getOAuthResponse')
            ->with('xxx')
            ->willReturn(null);
        $nullValue = $this->clientMock->getOAuthResponse('xxx');
        $this->assertNull($nullValue);
    }

    public function testGetLoginDataResponseReturnValidResponse()
    {
        $this->clientMock->method('getOAuthResponse')
            ->with('xxx')
            ->willReturn($this->_getMockResponse());

        $response = $this->clientMock->getOAuthResponse('xxx');
        $this->assertEquals($this->_getMockResponse(), $response);
    }

    private function _getMockResponse()
    {
        $obj = new \stdClass();
        $obj->givenName = 'xxxx';
        $obj->familyName = 'xxxx';
        $obj->email = 'xxxx';
        $obj->id = 'xxxx';

        $userInfo = $this->createMock(\Google\Service\Oauth2\Resource\Userinfo::class);

        $userInfo->method('get')
            ->willReturn($obj);

        $responseMock = $this->createMock(\Google\Service\Oauth2::class);
        $responseMock->userinfo = $userInfo;

        return $responseMock;
    }
}
