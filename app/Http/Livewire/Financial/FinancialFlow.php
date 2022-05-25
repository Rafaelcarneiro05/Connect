<?php

namespace App\Http\Livewire\Financial;

use App\Models\Financial;
use Livewire\Component;

class FinancialFlow extends Component
{

    public $cashflow = 'entrada';
    public $saida = 'despesas';
    public $descricao;

    public function entrada()
    {
        if($this->cashflow == 'entrada')
        {

        }
    }

    public function saida()
    {
        if($this->cashflow == 'saida')
        {
            $this->validate([
                'descricao' => 'string'
            ]);
        }
    }

    public Financial $newValue;

    public function mount(Financial $value)
    {
        $this->newValue = $value;
    }

    public function store()

    {

        $this->validate([
            'newValue.value' => 'numeric',
        ]);
        //dd($this->cashflow);
        $this->newValue->cashflow = $this->cashflow;
        $this->newValue->saida = $this->saida;
        $this->newValue->descricao = $this->descricao;
        $this->newValue->save();
        $this->newValue = new Financial();
        $this->emit(event: 'save');
        
    }



    public function render()
    {
        return view('livewire.financial.financial-flow');
    }

    protected function rules()
    {
        return [
            'newValue.value' => 'required|numeric',
            'descricao' => 'required|string'
        ];
    }
}
