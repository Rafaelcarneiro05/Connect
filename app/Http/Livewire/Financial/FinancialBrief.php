<?php

namespace App\Http\Livewire\Financial;

//models utilizadas

use App\Http\Livewire\Empresas\EmpresasCreate;
use App\Models\Financial;
use App\Models\Empresas;
use App\Models\Recorrentes;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class FinancialBrief extends Component
{

    public $valor_recorrente;
    public $updateMode = false;

    //EMPRESA
    public $empresa;
    public $empresas;
    public $empresas_id;



    //TELA DE PESQUISA
    use WithPagination;

    //public $financials;

    public $cashflow = 'entrada';
    public $from;
    public $to;
    public $items;
    public $balanco;
    public $balanco_entr;
    public $balanco_saida;
    public $balanco_taxa;
    public $soma;


    //TELA DE CADASTRO/EDIÇÃO
    public $isOpen = 0;
    public $financial_id;

    public $FIELD_cashflow = 'entrada';
    public $saida = 'despesas';
    public $descricao;
    public $valor;
    public $moeda = 'brl';
    public $fonte;
    public $observacao;
    public $data;
    public $cotacaoEmBRL;
    public $taxa;
    public $fracao;

    public $brl;



    public function create() //abrir modal para cadastro ----
    {
        $this->resetInputFields();
        $this->openModal();
    }


    public function edit($id)   //abrir modal para edicao ----
    {

        $financial = Financial::find($id);

        $this->financial_id = $id;

        $this->FIELD_cashflow = $financial->cashflow;
        $this->saida = $financial->saida;
        $this->descricao = $financial->descriacao;
        $this->valor = $financial->value;
        $this->moeda = $financial->moeda;
        $this->fonte = $financial->fonte;
        $this->observacao = $financial->observacao;
        $this->data = $financial->data;
        $this->cotacaoEmBRL = $financial->cotacaoEmBRL;
        $this->taxa = $financial->taxa;
        $this->fracao = $financial->fracao;
        $this->brl = $financial->brl;
        $this->empresas_id = $financial->empresas_id;

        $this->openModal();
    }



    public function openModal()
    {
        $this->isOpen = true;
    }


    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {

        $this->reset();
    }


    public function store()  //PROCESSAMENTO do cadastrar ou editar: updateOrCreate

    {


        //converte valor do formato 15.120,00 para 15120.00

        //VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR
        $valor_tratado = str_replace('.', '', $this->valor);
        $valor_tratado = str_replace(',', '.', $valor_tratado);
        $valor_tratado = str_replace('R$', '', $valor_tratado);
        $valor_tratado = str_replace(' ', '', $valor_tratado);

        //TAXA
        $taxa_tratada = null;
        if ($this->taxa) {
            $taxa_tratada = str_replace('.', '', $this->taxa);
            $taxa_tratada = str_replace(',', '.', $taxa_tratada);
            $taxa_tratada = str_replace('R$', '', $taxa_tratada);
            $taxa_tratada = str_replace(' ', '', $taxa_tratada);
        }

        //FRACAO
        $fracao_tratada = null;
        if ($this->fracao) {
            $fracao_tratada = str_replace('.', '', $this->fracao);
            $fracao_tratada = str_replace(',', '.', $fracao_tratada);
        }


        //COTACAO
        $cotacao_tratada = null;
        if ($this->cotacaoEmBRL) {
            $cotacao_tratada = str_replace('.', '', $this->cotacaoEmBRL);
            $cotacao_tratada = str_replace(',', '.', $cotacao_tratada);
            $cotacao_tratada = str_replace('R$', '', $cotacao_tratada);
            $cotacao_tratada = str_replace(' ', '', $cotacao_tratada);
        }


        //EDIÇÃO OU CRIAÇÃO updateOrCreate

        Financial::updateOrCreate(['id' => $this->financial_id], [
            'empresas_id' => $this->empresas_id,
            'cashflow' => $this->cashflow,
            'value' => $valor_tratado,
            'saida' => $this->saida,
            'descricao' => $this->descricao,
            'data' => $this->data,
            'moeda' => $this->moeda,
            'observacao' => $this->observacao,
            'fonte' => $this->fonte,
            'cotacaoEmBRL' => $cotacao_tratada,
            'taxa' => $taxa_tratada,
            'fracao' => $fracao_tratada,

        ]);



        $this->resetInputFields();

        session()->flash('message', 'Item registrado com sucesso.');

        $this->closeModal();
    }


    public $confirmingItemDeletion = false;

    public function confirmingItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function destroy($id)
    {

        Financial::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }


    public function render()
    {
        //SELECT EMPRESAS

        $this->empresas = Empresas::get();

        $this->recorretnes = Recorrentes::get();

        $where = [];

        if ($this->empresa) {

            $where[] = ['empresas_id', '=', $this->empresa];
        }


        if ($this->to) {

            $to_explodido = explode('/', $this->to);
            $to_explodido = array_reverse($to_explodido);
            $to_explodido = implode('-', $to_explodido);

            $where[] = ['data', '<=',   $to_explodido];
        }

        if ($this->from) {

            $from_explodido = explode('/', $this->from);
            $from_explodido = array_reverse($from_explodido);
            $from_explodido = implode('-', $from_explodido);

            $where[] = ['data', '>=',   $from_explodido];
        }


        $filter = $this->cashflow == '' ? ['entrada', 'saida'] : [$this->cashflow];





        $financials_retorno = Financial::where($where)->whereIn('cashflow', $filter)->orderBy('data', 'desc')->paginate(10);





        if ($this->cashflow == 'entrada') {
            $this->balanco_entr = Financial::where($where)->whereIn('cashflow', $filter)->sum('value');
            $this->balanco_saida = '0';
        } elseif ($this->cashflow == 'saida') {
            $this->balanco_saida = Financial::where($where)->whereIn('cashflow', $filter)->sum('value');
            $this->balanco_entr = '0';
        } else {
            $this->balanco_entr = Financial::where($where)->whereIn('cashflow', ['entrada'])->sum('value');
            $this->balanco_saida = Financial::where($where)->whereIn('cashflow', ['saida'])->sum('value');
            $this->balanco_taxa = Financial::where($where)->sum('taxa');
            $this->soma = $this->balanco_entr - $this->balanco_saida - $this->balanco_taxa;
        }


        return view('livewire.financial.financial-brief', [

            'financials_retorno' => $financials_retorno,
        ]);

        }


    }

