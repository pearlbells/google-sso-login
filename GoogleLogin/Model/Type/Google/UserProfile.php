<?php

namespace BA\GoogleLogin\Model\Type\Google;

use BA\GoogleLogin\Api\Data\LoginDataInterface;
use BA\GoogleLogin\Model\Data\LoginData;
use Magento\Framework\ObjectManagerInterface;

class UserProfile
{
    /**
     * 
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleClient
     */
    protected $client;

    public function __construct(
        GoogleClient $client,
        ObjectManagerInterface $objectManager
    ) {
        $this->client = $client;
        $this->objectManager = $objectManager;
    }

    public function getLoginData($authCode)
    {
        if ($response = $this->client->getOAuthResponse($authCode)) {
            return $this->createSocialObj($response->userinfo->get());
        }
        return null;
    }

    public function createSocialObj($userProfile)
    {
        return $this->objectManager->create(
            LoginData::class,
            [
                'data' => [
                    LoginDataInterface::FIRST_NAME => $userProfile->givenName,
                    LoginDataInterface::LAST_NAME => $userProfile->familyName,
                    LoginDataInterface::EMAIL => $userProfile->email,
                    LoginDataInterface::SOCIAL_ID => $userProfile->id,
                    LoginDataInterface::TYPE => 'google',
                    LoginDataInterface::SOCIAL_CREATED_AT => date('Y-m-d'),
                    LoginDataInterface::STATUS => 1
                ]
            ]
        );
    }
}
