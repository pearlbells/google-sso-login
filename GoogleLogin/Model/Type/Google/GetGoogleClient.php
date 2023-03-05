<?php
namespace BA\GoogleLogin\Model\Type\Google;

use BA\GoogleLogin\Model\Config\Config;
use BA\GoogleLogin\Model\Type\Google\GoogleClient;

class GetGoogleClient
{
    /**
     * @var \BA\GoogleLogin\Model\Config\Config
     */
    protected $config;
     
    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleClient
     */
    protected $client;

    public function __construct(
        Config $config,
        GoogleClient $client
    ) {
        $this->config = $config;
        $this->client = $client;
    }

    public function getAuthUrl()
    {
        $googleAuthUrl = $this->client->getClient();
        return $googleAuthUrl->createAuthUrl();
    }
}