<?php

namespace BA\GoogleLogin\Model\Type;

use BA\GoogleLogin\Model\Type\Google\GoogleLogin;
use Magento\Framework\App\RequestInterface;
use BA\GoogleLogin\Model\Type\Sanitize;

class Register implements RegisterInterface
{
    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Google\GoogleLogin
     */
    protected $googleLogin;

    /**
     * 
     * @var \BA\GoogleLogin\Model\Type\Sanitize
     */
    protected $sanitize;

    public function __construct(
        GoogleLogin $googleLogin,
        Sanitize $sanitize
    ) {
        $this->googleLogin = $googleLogin;
        $this->sanitize = $sanitize;
    }

    public function registerUser(RequestInterface $request): ?bool
    {
        $data = $this->sanitize->sanitizeVars($request->getParams());
        if ($data['type'] == 'google') {
            return $this->googleLogin->signIn($data['code']);
        }
    }
}
