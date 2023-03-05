<?php

namespace BA\GoogleLogin\Test\Unit\Model\Type\Google;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use BA\GoogleLogin\Model\Data\LoginData;
use BA\GoogleLogin\Model\Type\Google\GoogleLogin;
use Magento\Company\Model\Customer;
use PHPUnit\Framework\TestCase;

class GoogleLoginTest extends TestCase
{
    /**
     * @var \BA\GoogleLogin\Model\Type\Google\UserProfile|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $userProfileMock;

    /**
     * @var \BA\GoogleLogin\Model\Type\User\AccountHandler|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $accountHandlerMock;

    /**
     * @var \Magento\Customer\Model\Session|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $sessionMock;

    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleLogin
     */
    protected $googleLoginHandler;

    public function setUp(): void
    {
        $this->userProfileMock = $this->createMock(\BA\GoogleLogin\Model\Type\Google\UserProfile::class);
        $this->accountHandlerMock = $this->createMock(\BA\GoogleLogin\Model\Type\User\AccountHandler::class);
        $this->sessionMock = $this->createMock(\Magento\Customer\Model\Session::class);

        $this->googleLoginHandler = new GoogleLogin(
            $this->userProfileMock,
            $this->accountHandlerMock,
            $this->sessionMock
        );
    }

    public function testGetUserDataApiReturnLoginDataObject()
    {
        $code = '4/0AX4XfWj7FD9cA7shclaVhGDBZnyuMxFehllLAlWUCdOOhWPNJJf8ROzeMhxOosFk52bBoo';
        $loginDataObject = new LoginData();
        $this->userProfileMock->expects($this->once())
            ->method('getLoginData')
            ->with($code)
            ->willReturn($loginDataObject);

        $loginObj = $this->googleLoginHandler->getUserDataApi($code);
        
        $this->assertInstanceOf(LoginDataInterface::class, $loginObj);
    }

    public function testGetUserDataApiWillReturnNullWhenGivenInvalidCode()
    {
        $this->userProfileMock
            ->method('getLoginData')
            ->willReturn(null);

        $actual = $this->googleLoginHandler->getUserDataApi('abc123');
        $this->assertNull($actual);
    }

    public function testSaveCustomerReturnTrue()
    {
        $loginDataObject = new LoginData();
        $customerObj = $this->createMock(\Magento\Customer\Api\Data\CustomerInterface::class);
        $this->accountHandlerMock->expects($this->once())
            ->method('saveCustomer')
            ->with($loginDataObject)
            ->willReturn($customerObj);
        $customerStatus = $this->googleLoginHandler->saveCustomer($loginDataObject);
        $this->assertSame(true, $customerStatus) ;
    }

    public function testSaveCustomerReturnFalse()
    {
        $loginDataObject = new LoginData();
        $this->accountHandlerMock->expects($this->once())
            ->method('saveCustomer')
            ->with($loginDataObject)
            ->willReturn(null);
        $customerStatus = $this->googleLoginHandler->saveCustomer($loginDataObject);
        $this->assertSame(false, $customerStatus) ;
    }
}
