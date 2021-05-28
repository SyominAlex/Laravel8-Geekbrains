<?php


namespace App\Services;


use App\Exceptions\Orders\CreatingOrderIsNotAvailableNowException;
use App\Models\Order;

class OrderService
{ // если вся логика в сервисах, не составит никакого труда

    /*private DeliveryService $deliveryService;

    public function __construct(DeliveryService $deliveryService) // через DI
    {
        $this->deliveryService = $deliveryService;
    }*/

    public function create(string $name /*StoreOrderRequest $request проблема, когда передаем в сервис, который отвечает за бизнес-логику, реквест из http*/) // передаем имя заказчика, его надо куда-то сохранить
    {
        \Log::info('Calling create method in the service');
        if (!config('orders.able_to_create')) {
            throw new CreatingOrderIsNotAvailableNowException();
        }

        $order = Order::create(compact('name'));

        // @todo добавить создание файла
        // $this->deliveryService->initiateDelivery($order);

        return $order;
    }
}
