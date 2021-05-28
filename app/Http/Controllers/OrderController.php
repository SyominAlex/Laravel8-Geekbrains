<?php

namespace App\Http\Controllers;

use App\Exceptions\Orders\CreatingOrderIsNotAvailableNowException;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // PHP7
    private OrderService $orderService;

    public function __construct(OrderService $orderService) // подключение через DI в конструкторе, прописана зависимость
    {
        $this->orderService = $orderService;
    }

    // приятность PHP8
    /*public function __construct(private OrderService $orderService)
    {
        $this->orderService = $orderService;
    }*/

    public function store(/*Request*/ StoreOrderRequest $request/*, OrderService $orderService*/)
    {
        // если заказчик захочет подключить мобильное приложение, вынести эту логику на отдельный контроллер не составит труда
        // в случае API будет не redirect, а return json response
        \Log::info('Calling store method in the controller');
        try {
            $this->orderService->create($request->get('name'));
        } catch (CreatingOrderIsNotAvailableNowException $e) {
            return redirect()->back()->with('warning', 'Can not create an order right now ;(!');
        }

        return redirect()->back()->with('success', 'Success!');
    }
}
