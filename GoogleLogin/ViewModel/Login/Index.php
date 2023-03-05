<?php

namespace BA\GoogleLogin\ViewModel\Login;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use BA\GoogleLogin\Model\Config\Config;
use Magento\Framework\UrlInterface;
use BA\GoogleLogin\Model\Type\Google\GetGoogleClient;

class Index implements ArgumentInterface
{
    /**
     * @var \BA\GoogleLogin\Model\Config\Config
     */
    protected $config;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \BA\GoogleLogin\Model\Type\Google\GetGoogleClient
     */
    protected $getGoogleClient;

    public function __construct(
        UrlInterface $urlBuilder,
        Config $config,
        GetGoogleClient $getGoogleClient
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->config = $config;
        $this->getGoogleClient = $getGoogleClient;
    }

    public function getLabel()
    {
        return $this->config->getBtnLabel();
    }

    public function isEnabled()
    {
        return $this->config->isGoogleEnabled();
    }

    public function getAuthUrl()
    {
        return $this->getGoogleClient->getAuthUrl();
    }
}
