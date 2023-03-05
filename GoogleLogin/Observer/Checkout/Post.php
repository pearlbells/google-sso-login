<?php

namespace BA\GoogleLogin\Observer\Checkout;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlInterface;

class Post implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * 
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Framework\App\ResponseFactory
     */
    protected $responseFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    public function __construct(
        Session $checkoutSession,
        CustomerSession $customerSession,
        ResponseFactory $responseFactory,
        UrlInterface $url
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
        $this->responseFactory = $responseFactory;
        $this->url = $url;
    }

    public function execute(Observer $observer)
    {
        if ($this->customerSession->isLoggedIn()) {

            $redirectionUrl = $this->url->getUrl('checkout/index');
            $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();

            return $this;
        } else {
            $this->checkoutSession->setGoogleLogin(true);
        }
    }
}
