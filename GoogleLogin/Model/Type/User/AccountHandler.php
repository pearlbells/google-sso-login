<?php

namespace BA\GoogleLogin\Model\Type\User;

use BA\GoogleLogin\Model\Type\User\Customer;
use BA\GoogleLogin\Model\Type\User\SocialRespository;

class AccountHandler
{

    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\User\Customer
     */
    protected $customer;

    /**
     * @var \BA\GoogleLogin\Model\Type\User\SocialRespository
     */
    protected $socialRespository;

    public function __construct(
        Customer $customer,
        SocialRespository $socialRespository
    ) {
        $this->customer = $customer;
        $this->socialRespository = $socialRespository;
    }

    public function saveCustomer($userData)
    {
        $customer = $this->customer->getCustomer($userData);
        if ($customer) {
            $userData->setCustomerId($customer->getId());
            $this->socialRespository->saveSocialLogin($userData);
        }
        return $customer;
    }
}
