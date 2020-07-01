### 要求
1. PHP >= 7.0
2. **[Composer](https://getcomposer.org/)**
3. ext-curl 拓展
4. ext-json 拓展

### 安装

`composer require asialong/pinduoduo-sdk`

### 使用

```php

use \Asialong\PinduoduoSdk\Pdd;

require __DIR__ . '/vendor/autoload.php';
$config = [
    'client_id'    => 'xxxxxx69e3940c6b93xxxxxx',
    'client_secret' => 'c2eda0c398xxxxxxbd63ff57bf22c05xxxxxx',
    'debug'              => true,
    'member_type'        => 'MERCHANT',//用户角色 ：MERCHANT(商家授权),H5(移动端),多多客(JINBAO),
    'redirect_uri'       => 'https://test.xxx.com/callback',
    'log'                => [
        'name'       => 'pdd',
        'file'       => __DIR__ . '/pdd.log',
        'level'      => 'debug',
        'permission' => 0777,
    ],
];
$pdd = new Pdd($config);

```
### 调用示例


#### 调用无需授权接口示例
> 多多进宝商品详情查询 pdd.ddk.goods.detail
```php
$result   = $pdd->api->request('pdd.ddk.goods.detail', ['goods_id_list' => ['395581006']]);

```
#### 调用需授权接口示例

* 获取授权 URL
```php
$url = $pdd->pre_auth->authorizationUrl();
```
* 重定向到授权页面
```php
$pdd->pre_auth->authorizationRedirect();
```
* 在重定向页面，你可以获取此次授权账号的 token
```php
$token = $pdd->pre_auth->getAccessToken();
//也可以通过上面得到的 refresh_token 去刷新令牌
//$token = $pdd->pre_auth->refreshToken($token['refresh_token']);
```
* 创建授权应用
```php
$pinduoduo = $pdd->oauth->createAuthorization($token['token']);
```
> 获取当前账号下有多少推广位 pdd.ddk.oauth.goods.pid.query
```php
$result   = $pdd->auth_api->request('pdd.ddk.oauth.goods.pid.query');
```
### 文档
[拼多多开放平台](http://open.pinduoduo.com/)  · [官方文档](http://open.pinduoduo.com/#/apidocument)


### 感谢

-  [hanson/foundation-sdk](https://github.com/Hanson/foundation-sdk)

## License

MIT