<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $users;
    public function render()
    {
        $this->users=User::all();
        return view('livewire.user.edit');
    }
}
