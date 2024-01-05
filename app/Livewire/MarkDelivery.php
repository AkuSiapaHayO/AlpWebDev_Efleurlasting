<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class MarkDelivery extends Component
{
    public $orderId;

    public function mount($orderId)
    {   
        $this->orderId = $orderId;
    }

    public function markDelivery()
    {
        $order = Order::find($this->orderId);
        $order->update([
            'delivery_status' => true
        ]);

        return redirect()->route('orders.view')->with('success', 'Order Approved');
    }

    public function render()
    {
        return view('livewire.mark-delivery');
    }
}
