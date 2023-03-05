<?php
namespace BA\GoogleLogin\Model\Type\Google;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use BA\GoogleLogin\Api\Management\LoginInterface;
use BA\GoogleLogin\Model\Type\Google\UserProfile;
use BA\GoogleLogin\Model\Type\User\AccountHandler;
use Magento\Customer\Model\Session;

class GoogleLogin implements LoginInterface
{
    /**
     * @var \BA\GoogleLogin\Model\Type\Google\UserProfile
     */
    protected $loginData;

    /**
     * @var \BA\GoogleLogin\Model\Type\User\AccountHandler
     */
    protected $accountHandler;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $session;

    public function __construct(
        UserProfile $loginData,
        AccountHandler $accHandler,
        Session $session
    ) {
        $this->loginData = $loginData;
        $this->accountHandler = $accHandler;
        $this->session = $session;
    }

    public function signIn($code)
    {
        $userData = $this->getUserDataApi($code);
        if ($userData) {
            return $this->saveCustomer($userData);
        }
    }

    /**
     * Get the user data obj from api or null
     * 
     * @param mixed $code 
     * @return null|\BA\GoogleLogin\Api\Data\LoginDataInterface 
     */
    public function getUserDataApi($code) : ?LoginDataInterface
    {
        return $this->loginData->getLoginData($code);
    }

    public function saveCustomer(LoginDataInterface $loginData) : bool
    {
        $customer = $this->accountHandler->saveCustomer($loginData);
        if ($customer) {
            $this->refresh($customer);
            return true;
        }
        return false;
    }

    private function refresh($customer)
    {
        if ($customer && $customer->getId()) {
            $this->session->setCustomerDataAsLoggedIn($customer);
            $this->session->regenerateId();
        }
    }
}