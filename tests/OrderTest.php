<?php
namespace SombeMerchant;
use SombeMerchant\Merchant\Order;

class OrderTest extends TestBase {
    
    public function testCreateOrderInValid() {
        $this->expectException(\SombeMerchant\Unauthorized::class);
        $this->assertFalse(Order::create([], Self::getConfigurations()));
    }

    public function testCreateOrderValid() {
        $this->assertNotFalse(Order::create(Self::getOrderData(), Self::getConfigurations()));
    }

    public function getOrderData() {
        return [
            'OrderId' => rand(1111,9999), //Your order Id
            'currency' => 'ALL',
            'amount' => '0.01',
            'title' => 'your title',
            'description' => 'your order description.',
            'callback_url' => 'https://yourdomain/callback_url',
            'cancel_url' => 'https://yourdomain/cancel_url',
            'success_url' => 'https://yourdomain/success_url',
        ]; 
    }

    public function testOrderIsNotFound() {
        $this->assertFalse(Order::find(0, Self::getConfigurations()));
    }
    
    public function testOrderIsFound() {
        $order = Order::create(Self::getOrderData(), Self::getConfigurations());
        $this->assertNotFalse(Order::find($order->id, Self::getConfigurations()));
    }
}
