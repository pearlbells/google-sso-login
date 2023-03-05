<?php
namespace BA\GoogleLogin\Model\Type\Google;

class GoogleClient
{
    /**
     * @var \Google\Client
     */
    private $client;

    /**
     * @var \BA\GoogleLogin\Model\Config\Config
     */
    private $clientConfig;

    public function __construct(
        \BA\GoogleLogin\Model\Config\Config $clientConfig
    ) {
        $this->clientConfig = $clientConfig;
    }

    /**
     * @return \Google\Client 
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new \Google\Client(['approval_prompt' => 'force']);

            $this->addCredentials($this->client);
        }

        return $this->client;
    }

    public function addCredentials(\Google\Client $client)
    {
        $client->setClientId($this->clientConfig->getGoogleAppId());
        $client->setClientSecret($this->clientConfig->getGoogleAppSecret());
        $client->setRedirectUri($this->clientConfig->getGoogleRedirect());
        $client->addScope('email');
        $client->addScope('profile');

        return $client;
    }

    public function validate($code): bool
    {
        try {
            $token = $this->getClient()->fetchAccessTokenWithAuthCode($code);
        } catch (\Exception $e) {
            return false;
        }

        if (empty($token['access_token']) || isset($token['error']))  {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $code 
     * @return \Google\Service\Oauth2|null 
     */
    public function getOAuthResponse($code)
    {
        if ($this->validate($code)) {
            return new \Google\Service\Oauth2(
                $this->getClient()
            );
        }

        return null;
    }
}