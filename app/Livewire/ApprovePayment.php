<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class ApprovePayment extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function approvePayment()
    {
        $order = Order::find($this->orderId);
        $order->payment_status = true;
        $order->save();

        return redirect()->route('payment.view')->with('success', 'Payment Approved!');
    }

    public function render()
    {
        return view('livewire.approve-payment');
    }
}
