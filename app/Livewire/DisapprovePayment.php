<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class DisapprovePayment extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function disapprovePayment()
    {
        $order = Order::find($this->orderId);
        $order->delete();

        return redirect()->route('payment.view')->with('success', 'Order Deleted');
    }

    public function render()
    {
        return view('livewire.disapprove-payment');
    }
}
