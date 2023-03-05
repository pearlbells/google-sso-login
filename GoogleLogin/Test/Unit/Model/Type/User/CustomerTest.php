<?php

namespace BA\GoogleLogin\Test\Unit\Model\Type\User;

use BA\GoogleLogin\Model\Type\User\Customer;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * 
     * @var \Magento\Customer\Api\CustomerRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRepositoryMock;

    /**
     * @var \Magento\Customer\Api\Data\CustomerInterfaceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerDataFactoryMock;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeManagerMock;

    /**
     * @var \Magento\Framework\Math\Random|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $randomHashMock;

    /**
     * @var \BA\GoogleLogin\Model\Type\User\Customer
     */
    protected $customerObject;

    public function setUp(): void
    {
        $this->customerRepositoryMock = $this->createMock(\Magento\Customer\Api\CustomerRepositoryInterface::class);
        $this->customerDataFactoryMock = $this->createMock(\Magento\Customer\Api\Data\CustomerInterfaceFactory::class);
        $this->storeManagerMock = $this->createMock(\Magento\Store\Model\StoreManagerInterface::class);
        $this->randomHashMock = $this->createMock(\Magento\Framework\Math\Random::class);

        $this->customerObject = new Customer(
            $this->customerRepositoryMock,
            $this->customerDataFactoryMock,
            $this->storeManagerMock,
            $this->randomHashMock
        );
    }

    public function testGetCustomerByEmailException()
    {
        $email = 'test@test.com';

        $this->customerRepositoryMock->expects($this->once())
            ->method('get')
            ->with($email)
            ->willThrowException(new NoSuchEntityException());

        $customer = $this->customerObject->getCustomerByEmail($email);
        $this->assertNull($customer);
    }

    public function testGetCustomerByEmail()  
    {
        $email = 'test@test.com';
        $customer = $this->createMock(CustomerInterface::class);

        $this->customerRepositoryMock->expects($this->once())
            ->method('get')
            ->with($email)
            ->willReturn($customer);
            
        $customerObj = $this->customerObject->getCustomerByEmail($email);
        $this->assertInstanceOf(CustomerInterface::class, $customerObj);

    }
}
