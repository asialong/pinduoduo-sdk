<?php
namespace Asialong\PinduoduoSdk;

use Hanson\Foundation\Foundation;

/**
 * Class Pdd.
 *
 * @property \Asialong\PinduoduoSdk\Api           $api
 * @property \Asialong\PinduoduoSdk\Api           $auth_api
 * @property \Asialong\PinduoduoSdk\BaseAccessToken   $access_token
 * @property \Asialong\PinduoduoSdk\Oauth\PreAuth $pre_auth
 * @property \Asialong\PinduoduoSdk\Oauth\Oauth   $oauth
 */
class Pdd extends Foundation
{
    protected $providers = [
        ServiceProvider::class,
        Oauth\ServiceProvider::class,
    ];
}