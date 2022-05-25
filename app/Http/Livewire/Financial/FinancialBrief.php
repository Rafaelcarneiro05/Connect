<?php

namespace App\Http\Livewire\Financial;

use App\Models\Financial;
use Livewire\Component;
use Livewire\WithPagination;

class FinancialBrief extends Component
{
    use WithPagination;

    

    public $search = '';


    public function render()
    {
        $financials = Financial::get();

        return view('livewire.financial.financial-brief' , [
            'financials' => $financials
        ]);
    }
}
