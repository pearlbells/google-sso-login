<?php
namespace BA\GoogleLogin\Model\Type\Google;

use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth;

class GoogleServiceOauthFactory
{
    /**
     * Create a new Google_Service_Oauth2 instance
     *
     * @param GoogleClient $client
     * @return GoogleServiceOauth
     */
    public function create(GoogleClient $client): GoogleServiceOauth
    {
        return new GoogleServiceOauth($client);
    }
}