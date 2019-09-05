<?php
namespace SombeMerchant\Merchant;

use SombeMerchant\SombeMerchant;
use SombeMerchant\OrderIsNotValid;
use SombeMerchant\OrderNotFound;

class Order
{
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function toHash()
    {
        return $this->order;
    }

    public function __get($name)
    {
        return $this->order[$name];
    }

    public static function find($orderId, $authentication = array())
    {
        try {
            return self::findOrFail($orderId, $authentication);
        } catch (OrderNotFound $e) {
            return false;
        }
    }

    public static function findOrFail($orderId, $authentication = array())
    {
        $order = SombeMerchant::request('/order/' . $orderId, 'GET', $authentication);
        return new self($order['response']);
    }

    public static function create($params, $authentication = array())
    {
        try {
            return self::createOrFail($params, $authentication);
        } catch (OrderIsNotValid $e) {
            return false;
        }
    }

    public static function createOrFail($params, $authentication = array())
    {
        $order = SombeMerchant::request('/order', 'POST', $authentication, $params);
        return new self($order['response']);
    }
}
