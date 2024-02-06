<?php

namespace App\Livewire\Salle;

use App\Models\salle;
use Livewire\Component;

class Edit extends Component
{
    public $salles;
    public function render()
    {
        $this->salles=salle::get();
        return view('livewire.salle.edit');
    }
}
