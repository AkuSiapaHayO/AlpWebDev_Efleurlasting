<?php

namespace App\Livewire;

use Livewire\Component;

class Chat extends Component
{
    public function render()
    {
        return view('livewire.chat');
    }

    public function whatsAppChat()
    {
        $adminPhoneNumber = '+628983979074';

        $whatsappLink = "whatsapp://send?phone={$adminPhoneNumber}";
        return redirect()->to($whatsappLink);
    }
}
