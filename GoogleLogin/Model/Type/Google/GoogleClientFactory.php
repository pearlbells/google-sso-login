<?php
namespace BA\GoogleLogin\Model\Type\Google;

use Google\Client as GoogleClient;

class GoogleClientFactory
{
    /**
     * Create a new Google Client instance
     *
     * @return GoogleClient
     */
    public function create()
    {
        return new GoogleClient(['approval_prompt' => 'force']);
    }
}