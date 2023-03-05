<?php
namespace BA\GoogleLogin\Api\Management;

use BA\GoogleLogin\Api\Data\LoginDataInterface;

interface LoginInterface
{

    /**
     * Sign using the code
     * 
     * @param mixed $code 
     * @return mixed 
     */
    public function signIn($code);

    /**
     * Get the user details using the code
     * @param mixed $code 
     * @return \BA\GoogleLogin\Api\Data\LoginDataInterface|null 
     */
    public function getUserDataApi($code) : ?LoginDataInterface;

    /**
     * Save the customer data - customer table and social login table
     * 
     * @param \BA\GoogleLogin\Api\Data\LoginDataInterface $loginData 
     * @return \Magento\Customer\Api\Data\CustomerInterface 
     */
    public function saveCustomer(LoginDataInterface $loginData) : bool;

}