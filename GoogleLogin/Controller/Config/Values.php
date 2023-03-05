<?php
namespace BA\GoogleLogin\Controller\Config;

use Magento\Framework\Controller\Result\JsonFactory;
use BA\GoogleLogin\Model\Config\Config;
use BA\GoogleLogin\Model\Type\Google\GetGoogleClient;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Values implements HttpGetActionInterface
{

    /**
     * @var \BA\GoogleLogin\Model\Config\Config
     */
    protected $config;

    /**
     * @var \BA\GoogleLogin\Model\Type\Google\GetGoogleClient
     */
    protected $getGoogleClient;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Config $config,
        GetGoogleClient $getGoogleClient,
        JsonFactory $jsonFactory
    ) {
        $this->config = $config;
        $this->jsonFactory = $jsonFactory;
        $this->getGoogleClient = $getGoogleClient;
    }

    public function execute()
    {
        $response = [];
        $response = [
            'btnEnabled' => $this->config->isGoogleEnabled(),
            'btnValue' => $this->config->getBtnLabel(),
            'authUrl'   => $this->getGoogleClient->getAuthUrl()
        ];
        $result = $this->jsonFactory->create();
        return $result->setData($response);
    }
}