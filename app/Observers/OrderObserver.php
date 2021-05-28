<?php

namespace App\Observers;

use App\Events\Orders\OrderCreated;

class OrderObserver
{
    public function created(Order $order)
    {
        OrderCreated::dispatch($order);
    }
}
