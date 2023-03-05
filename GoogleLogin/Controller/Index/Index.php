<?php

namespace BA\GoogleLogin\Controller\Index;

use BA\GoogleLogin\Model\Type\RegisterInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\RequestInterface;

class Index implements HttpGetActionInterface
{

    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\RegisterInterface
     */
    protected $register;

    /**
     * 
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    protected $request;

    public function __construct(
        ManagerInterface $messageManager,
        RegisterInterface $register,
        ResultFactory  $resultFactory,
        Session $checkoutSession,
        RequestInterface $request
    ) {
        $this->messageManager = $messageManager;
        $this->register = $register;
        $this->resultFactory = $resultFactory;
        $this->checkoutSession = $checkoutSession;
        $this->request = $request;
    }

    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        try {
            if ($this->register->registerUser($this->request)) {
                $redirect->setPath($this->getRedirectUrl());
            } else {
                throw new \Exception('Login Invalid');
                //$redirect->setPath('customer/account/login');
            }
        } catch (\Exception $e) {
            $redirect->setPath('customer/account/login');
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $redirect;
    }

    /**
     * Redirect url based on the checkout session exist
     * 
     * @return string 
     */
    private function getRedirectUrl()
    {
        if ($this->checkoutSession->getGoogleLogin()) {
            $this->checkoutSession->setGoogleLogin(false);
            return 'checkout/index';
        } else {
            return 'customer/account';
        }
    }
}
