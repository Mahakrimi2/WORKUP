<?php

namespace App\Livewire\Notification;

use App\Models\reservation;
use Livewire\Component;

class Navbar extends Component
{
    public $nbRes=0;
    public function render()
    {
        $this->nbRes=reservation::all();
        return view('livewire.notification.navbar');
    }
}
