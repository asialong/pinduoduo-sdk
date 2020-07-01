<?php
namespace Asialong\PinduoduoSdk\Oauth;

use Asialong\PinduoduoSdk\Pdd;

class Oauth
{
    /**
     * @var Pdd
     */
    private $app;

    public function __construct(Pdd $app)
    {
        $this->app = $app;
    }

    /**
     * @param     $token
     * @param int $expires
     *
     * @return Pdd
     */
    public function createAuthorization($token, $expires = 86399)
    {
        $accessToken = new AccessToken(
            $this->app->getConfig('client_id'),
            $this->app->getConfig('client_secret')
        );

        $accessToken->setToken($token, $expires);

        $this->app->access_token = $accessToken;

        return $this->app;
    }
}