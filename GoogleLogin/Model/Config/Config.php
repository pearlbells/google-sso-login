<?php

namespace BA\GoogleLogin\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    const XML_GOOGLE_ENABLED = 'social_login/google/is_google_enabled';
    const XML_GOOGLE_APPID = 'social_login/google/app_id';
    const XML_GOOGLE_APPSECRET = 'social_login/google/app_secret'; 
    const XML_GOOGLE_REDIRECT_URL = 'social_login/google/redirect_uri';
    const XML_BTN_LABEL = 'social_login/google/btn_label';

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    
    public function isGoogleEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_GOOGLE_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getGoogleAppId()
    {
        return $this->scopeConfig->getValue(
            self::XML_GOOGLE_APPID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getGoogleAppSecret()
    {
        return $this->scopeConfig->getValue(
            self::XML_GOOGLE_APPSECRET,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getGoogleRedirect()
    {
        return $this->scopeConfig->getValue(
            self::XML_GOOGLE_REDIRECT_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }


    public function getBtnLabel()
    {
        return $this->scopeConfig->getValue(
            self::XML_BTN_LABEL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
