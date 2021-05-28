<?php


namespace App\Services;


class DeliveryService
{

    public function __construct(OrderService $orderService) // циркулярная зависимость DeliveryService от OrderService
    {
    }

    public function initiateDelivery(Order $order) // OrderService не должен знать ничего про DeliveryService = SRP
    {
        // ...
    }
}
