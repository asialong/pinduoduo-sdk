<?php
namespace Asialong\PinduoduoSdk;

use Hanson\Foundation\Foundation;

/**
 * Class Dispatch
 * @package asialong/pinduoduo-sdk
 *
 * @method array getToken($params)
 */
class Dispatch extends Foundation
{

    private $pdd;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->pdd = new Pdd($this);
    }

    public function __call($name, $arguments)
    {
        return $this->pdd->{$name}(...$arguments);
    }
}