<?php

namespace App\Events\Orders;

use App\Models\Order;
/*use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;*/
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use Dispatchable, /*InteractsWithSockets,*/ SerializesModels;

    public Order $order;

    /**
     * Create a new event instance.
     *
     * @return Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    // с сокетами не работаем, бродкасты не нужны
    /*public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
