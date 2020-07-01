<?php
namespace Asialong\PinduoduoSdk;

use Hanson\Foundation\AbstractAccessToken;
use Hanson\Foundation\Foundation;

class BaseAccessToken extends AbstractAccessToken
{
    const TOKEN_API = 'http://open-api.pinduoduo.com/oauth/token';
    protected $code;

    public function __construct(array $config, Foundation $app)
    {
        parent::__construct($app);
        $this->appId = $config['client_id'];
        $this->secret = $config['client_secret'];
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