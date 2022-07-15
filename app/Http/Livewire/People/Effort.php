<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use Livewire\WithPagination;

//Models Ultilizadas
use App\Models\User;

class Effort extends Component
{

     //ATRIBUTOS
     use WithPagination;

     public $data;
     public $inicio;
     public $break; 
     public $volta;
     public $termino;
     public $project;
     public $var1;
     public $var2;
    
    
    
    
    
    
    
    public function render()
    {
        return view('livewire.people.effort');
    }



    public function inicio()
    {
        return view('livewire.people.effort');
    }

    public function break()
    {
        return view('livewire.people.effort');
    }

    public function reinicio()
    {
        return view('livewire.people.effort');
    }
    
    public function termino()
    {
        return view('livewire.people.effort');
    }
}

