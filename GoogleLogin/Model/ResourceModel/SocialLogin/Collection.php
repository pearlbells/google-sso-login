<?php
namespace BA\GoogleLogin\Model\ResourceModel\SocialLogin;

use BA\GoogleLogin\Model\SocialLogin;
use BA\GoogleLogin\Model\ResourceModel\SocialLogin as ResourceModelSocialLogin;
use Magento\Catalog\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SocialLogin::class, ResourceModelSocialLogin::class);
    }
}