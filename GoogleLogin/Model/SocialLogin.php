<?php

namespace BA\GoogleLogin\Model;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use Magento\Framework\Model\AbstractModel;
use BA\GoogleLogin\Model\ResourceModel\SocialLogin as SocialLoginResourceModel;

class SocialLogin extends AbstractModel
{
    /**
     * Cache tag
     */
    const CACHE_TAG = LoginDataInterface::SCHEMA_NAME;
    protected function _construct()
    {
        $this->_init(SocialLoginResourceModel::class);
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

}
