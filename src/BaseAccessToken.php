<?php
namespace Asialong\PinduoduoSdk;

use Hanson\Foundation\AbstractAccessToken;

class BaseAccessToken extends AbstractAccessToken
{
    const TOKEN_API = 'http://open-api.pinduoduo.com/oauth/token';
    protected $code;

    /**
     * key of token in json.
     *
     * @var string
     */
    protected $tokenJsonKey = 'access_token';

    /**
     * key of expires in json.
     *
     * @var string
     */
    protected $expiresJsonKey = 'expires_in';

    public function __construct($clientId, $secret)
    {
        $this->appId = $clientId;
        $this->secret = $secret;
    }

    /**
     * 使用code从服务器获取token
     * @return mixed
     * @throws \Exception
     */
    public function getTokenFromServer()
    {
        if (!empty($_GET['code'])) {
            $this->setCode(trim($_GET['code']));
        }
        if (empty($this->code)) {
            throw new \Exception('code不能为空');
        }
        $response = $this->getHttp()->json(self::TOKEN_API, [
            'client_id'     => $this->appId,
            'client_secret' => $this->secret,
            'grant_type'    => 'authorization_code',
            'code'          => $this->code,
        ]);

        return json_decode(strval($response->getBody()), true);
    }

    /**
     * 检测是否有错误信息
     * @param $result
     * @return bool|mixed
     * @throws \Exception
     */
    public function checkTokenResponse($result)
    {
        if (isset($result['error_response'])) {
            throw new \Exception($result['error_response']['error_msg'], $result['error_response']['code']);
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $code
     *
     * @return AccessToken
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

}