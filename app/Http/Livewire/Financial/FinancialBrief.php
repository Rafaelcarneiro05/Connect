<?php

namespace App\Http\Livewire\Financial;

//models utilizadas

use App\Models\Financial;
use App\Models\Empresas;



use Livewire\Component;

//PAGINAÇÃO
use Livewire\WithPagination;




class FinancialBrief extends Component
{

    public $valor_recorrente;
    public $updateMode = false;

    //EMPRESA
    public $empresa;
    public $empresas;
    public $empresas_id;

    //PDF
    public $from_pdf;
    public $to_pdf;
    //TELA DE PESQUISA
    use WithPagination;



    public $cashflow = '';
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
        $this->valor = 'R$' .number_format($financial->value, 2,',', '.');
        $this->moeda = $financial->moeda;
        $this->fonte = $financial->fonte;
        $this->observacao = $financial->observacao;
        $this->data = $financial->data;
        $this->cotacaoEmBRL = $financial->cotacaoEmBRL;
        $this->taxa = 'R$' .number_format($financial->taxa, 2,',', '.');
        $this->fracao = $financial->fracao;
        $this->brl = $financial->brl;
        $this->empresas_id = $financial->empresas_id;

        $this->openModal();
    }



    public function openModal() // ABRIR MODAL DE CADASTRO
    {
        $this->isOpen = true;
    }


    public function closeModal() //FECHAR MODAL DE CADASTRO
    {
        $this->isOpen = false;
    }

    private function resetInputFields() //RESETAR CAMPOS PARA NOVO CADASTRO
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

    public function confirmingItemDeletion($id) //CONFIRMAR DELETE
    {
        $this->confirmingItemDeletion = $id;
    }

    public function destroy($id) //DELETAR
    {

        Financial::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }

    public function pdf() // DOWNLOAD PDF PELA SESSION
    {
        //BUSCA PDF


        $this->empresas = Empresas::get();

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
        //dd($this->from);
        $financials_retorno = Financial::where($where)->whereIn('cashflow', $filter)->orderBy('data', 'desc')->get();

        //SOMATORIO FECHAMENTO DE CAIXA

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



        //FORMATANDO DATA PARA PDF
        $from_pdf = '';
        if ($this->from) {
            $from_pdf = explode('-', $this->from);
            $from_pdf = array_reverse($from_pdf);
            $from_pdf = implode('/', $from_pdf);
        }
        $to_pdf = '';
        if ($this->to) {
            $to_pdf = explode('-', $this->to);
            $to_pdf = array_reverse($to_pdf);
            $to_pdf = implode('/', $to_pdf);
        }







        //guardar os dados na sessão
        session()->put('financial_brief_financials_retorno_pdf', $financials_retorno);
        session()->put('financial_brief_from_explodido_pdf', $from_pdf);
        session()->put('financial_brief_to_explodido_pdf', $to_pdf);
        session()->put('financial_brief_cash_flow_pdf', $this->cashflow);
        session()->put('financial_brief_cbalanco_entr_pdf', $this->balanco_entr);
        session()->put('financial_brief_balanco_saida_pdf', $this->balanco_saida);
        session()->put('financial_brief_balanco_taxa_pdf', $this->balanco_taxa);
        session()->put('financial_brief_soma_pdf', $this->soma);



        redirect()->route('financial_pdf');

    }

    public function render()
    {
        //SELECT EMPRESAS

        $this->empresas = Empresas::get();

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

