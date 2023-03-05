<?php

namespace BA\GoogleLogin\Model\Type;

use Magento\Framework\App\RequestInterface;

interface RegisterInterface
{
    /**
     * Regstering the user with site 
     * usig the authenication details provided
     * 
     * @param mixed $code 
     * @param mixed $type 
     * @return bool 
     */
    public function registerUser(RequestInterface $request): ?bool;
}
