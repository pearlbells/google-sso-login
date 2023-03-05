<?php

namespace BA\GoogleLogin\Model\Type\User;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Math\Random;
use Magento\Framework\Exception\TemporaryState\CouldNotSaveException;

class Customer
{
    /**
     * 
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * 
     * @var \Magento\Customer\Api\Data\CustomerInterfaceFactory
     */
    protected $customerDataFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Math\Random
     */
    protected $randomHash;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerDataFactory,
        StoreManagerInterface $storeManager,
        Random $randomHash
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerDataFactory = $customerDataFactory;
        $this->storeManager = $storeManager;
        $this->randomHash = $randomHash;
    }

    public function getCustomer($userProfile)
    {
        $customer = $this->getCustomerByEmail($userProfile->getEmail());
        if (!$customer) {
            $customer = $this->createNewCustomer($userProfile);
        }
        return $customer;
    }

    /**
     * 
     * @param mixed $email 
     * @return null|\Magento\Customer\Api\Data\CustomerInterface 
     * @throws \Magento\Framework\Exception\LocalizedException 
     */
    public function getCustomerByEmail($email)
    {
        try {
            $customer = $this->customerRepository->get($email);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $customer = null;
        }
        return $customer;
    }

    private function createNewCustomer($userProfile)
    {
        try {
            $customer = $this->customerDataFactory->create();
            $customer->setFirstname($userProfile->getFirstName())
                ->setLastname($userProfile->getLastName())
                ->setEmail($userProfile->getEmail())
                ->setStoreId($this->storeManager->getStore()->getId())
                ->setWebsiteId($this->storeManager->getWebsite()->getId())
                ->setCreatedIn($this->storeManager->getStore()->getName());
            return $this->customerRepository->save($customer, $this->randomHash->getUniqueHash());
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('Customer save error')
            );
            return null;
        }
    }
}
