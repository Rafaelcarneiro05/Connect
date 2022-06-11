<?php

namespace App\Http\Livewire\WorkingDay;

use Livewire\Component;




class Register extends Component
{
    public $dinheiro;

    public $hora;


    public function render()
    {
        return view('livewire.working-day.register');
    }
}
