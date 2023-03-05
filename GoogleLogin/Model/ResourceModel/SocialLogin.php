<?php
namespace BA\GoogleLogin\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use BA\GoogleLogin\Api\Data\LoginDataInterface;

class SocialLogin extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(LoginDataInterface::SCHEMA_NAME, LoginDataInterface::ID);
    }
}