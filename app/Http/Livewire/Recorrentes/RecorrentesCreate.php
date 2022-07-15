<?php

namespace App\Http\Livewire\Recorrentes;

use App\Models\Recorrentes;
use Livewire\Component;
use Livewire\WithPagination;


class RecorrentesCreate extends Component
{

    use WithPagination;



    //TELA DE CADASTRO/EDIÇÃO
    public $isOpen = 0;
    public $recorrentes_id;
    public $searchTerm;


    //TELA DE REGISTRO
    public $categoria;
    public $descricao;
    public $value;
    public $fonte;
    public $observacao;
    public $taxa;
    public $data;



    public function create() //abrir modal para cadastro ----
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)
    {
        $recorrentes = Recorrentes::find($id);

        $this->recorrentes_id = $id;

        $this->categoria = $recorrentes->categoria;
        $this->descricao = $recorrentes->descricao;
        $this->value = $recorrentes->value;
        $this->fonte = $recorrentes->fonte;
        $this->observacao = $recorrentes->observacao;
        $this->taxa = $recorrentes->taxa;
        $this->data = $recorrentes->data;

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

        //VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR//VALOR
        $valor_tratado = str_replace('.', '', $this->value);
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

        //EDIÇÃO OU CRIAÇÃO updateOrCreate

        Recorrentes::updateOrCreate(['id' => $this->recorrentes_id], [
            'descricao' => $this->descricao,
            'value' => $valor_tratado,
            'fonte' => $this->fonte,
            'observacao' => $this->observacao,
            'taxa' => $taxa_tratada,
            'data' => $this->data,

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

        Recorrentes::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }


    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.recorrentes.recorrentes-create',[

        'recorrentes_retorno' => Recorrentes::where('descricao','like', $searchTerm)->orderBy('data', 'desc')->paginate(5)]);
    }
}
