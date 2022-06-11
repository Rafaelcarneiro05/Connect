<?php

namespace App\Http\Livewire\Financial;

use App\Models\Financial;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class FinancialBrief extends Component
{
    use WithPagination;

    public $cashflow = 'entrada';
    public $from;
    public $to;
    public $items;
    public $balanco;
    public $balanco_entr;
    public $balanco_saida;
    public $soma;

    public $passou_pelo_search = false;

    protected $financials;
    

    public function search()
    {
        
    }
    

    public function render()
    {
        //$financials = Financial::get();
        
        //die('aaaa');


        $where = [];

        

        if ($this->to) {

            $to_explodido = explode('/', $this->to);
            $to_explodido = array_reverse($to_explodido);
            $to_explodido = implode('-', $to_explodido);

            $where[] = ['created_at', '<=',   $to_explodido];
        }

        if ($this->from) {

            $from_explodido = explode('/', $this->from);
            $from_explodido = array_reverse($from_explodido);
            $from_explodido = implode('-', $from_explodido);

            $where[] = ['created_at', '>=',   $from_explodido];
        }

        $filter = $this->cashflow == '' ? ['entrada', 'saida'] : [ $this->cashflow ];
    
       
        $this->financials = Financial::where($where)->whereIn('cashflow', $filter)->orderBy('created_at','desc')->paginate(10);





        if( $this->cashflow == 'entrada')
        {
            $this->balanco_entr = Financial::where($where)->whereIn('cashflow', $filter)->sum('value');
            $this->balanco_saida = '0';
        }elseif($this->cashflow == 'saida') 
        {
            $this->balanco_saida = Financial::where($where)->whereIn('cashflow', $filter)->sum('value');
            $this->balanco_entr = '0';
        }else
        {
            $this->balanco_entr = Financial::where($where)->whereIn('cashflow',['entrada'])->sum('value');
            $this->balanco_saida = Financial::where($where)->whereIn('cashflow',['saida'])->sum('value');
            $this->soma = $this->balanco_entr - $this->balanco_saida;
        
        }
        

        




         
       
        
        return view('livewire.financial.financial-brief', [
           // 'financials' => $financials,
            'financials_retorno' =>  $this->financials
            //dd($financials),
            
            
            
        ]);
    }
}
