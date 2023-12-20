<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $quantity = 1;

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        $this->quantity = max(1, $this->quantity - 1);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
