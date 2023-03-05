<?php

namespace BA\GoogleLogin\Model\Type\User;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use BA\GoogleLogin\Model\ResourceModel\SocialLogin as SocialResourceModel;
use BA\GoogleLogin\Model\ResourceModel\SocialLogin\CollectionFactory;
use BA\GoogleLogin\Model\SocialLoginFactory;

class SocialRespository
{
    /**
     * 
     * @var \BA\GoogleLogin\Model\ResourceModel\SocialLogin\CollectionFactory
     */
    protected $socialCollection;

    /**
     * 
     * @var \BA\GoogleLogin\Model\ResourceModel\SocialLogin
     */
    protected $socialResource;

    /**
     * @var \BA\GoogleLogin\Model\SocialLoginFactory
     */
    protected $socialLoginFactory;

    public function __construct(
        CollectionFactory $socialCollection,
        SocialResourceModel $socialResource,
        SocialLoginFactory $socialLoginFactory
    ) {
        $this->socialCollection = $socialCollection;
        $this->socialResource = $socialResource;
        $this->socialLoginFactory = $socialLoginFactory;
    }

    public function saveSocialLogin($socialObj)
    {
        $socialCustomer = $this->getSocialCustomer($socialObj);
        if (!$socialCustomer->getId()) {
            $this->createSocialUser($socialObj);
        }
    }

    private function getSocialCustomer($socialObj)
    {
        $socialCustomer = $this->socialCollection->create()
            ->addFieldToFilter(LoginDataInterface::SOCIAL_ID, $socialObj->getSocialId())
            ->addFieldToFilter(LoginDataInterface::CUSTOMER_ID, $socialObj->getCustomerId())
            ->addFieldToFilter(LoginDataInterface::TYPE, $socialObj->getType())
            ->addFieldToFilter(LoginDataInterface::STATUS, 1)
            ->getFirstItem();
        return $socialCustomer;
    }

    private function createSocialUser($socialObj)
    {
        $socialLogin = $this->socialLoginFactory->create();
        $socialLogin->setData(LoginDataInterface::SOCIAL_ID, $socialObj->getSocialId());
        $socialLogin->setData(LoginDataInterface::CUSTOMER_ID, $socialObj->getCustomerId());
        $socialLogin->setData(LoginDataInterface::TYPE, $socialObj->getType());
        $socialLogin->setData(LoginDataInterface::SOCIAL_CREATED_AT, date('Y-m-d'));
        $socialLogin->setData(LoginDataInterface::STATUS, 1);
        $this->socialResource->save($socialLogin);
        // try {
        //     $this->socialResource->save($socialObj);
        // } catch (\Exception $exception) {
        //     throw new CouldNotSaveException(__(
        //         'Could not save the entity: %1',
        //         $exception->getMessage()
        //     ));
        // }
    }
}
