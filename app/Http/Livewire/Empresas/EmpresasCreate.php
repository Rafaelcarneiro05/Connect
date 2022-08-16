<?php

namespace App\Http\Livewire\Empresas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empresas;

class EmpresasCreate extends Component
{
    use WithPagination;
    public $updateMode = false;
    public $searchTerm;


    public $empresas;
    public $name;
    public $registro_marca;
    public $cnpj;
    public $email;
    public $sociedade = 'n';
    public $nome_socios;

    //TELA DE CADASTRO/EDIÇÃO
    public $isOpen = 0;
    public $empresas_id;


    public function create() // abrir modal para cadastro
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id) //abrir modal para edição
    {
        $empresas = Empresas::find($id);

        $this->empresas_id = $id;
        $this->name = $empresas->name;
        $this->registro_marca = $empresas->registro_marca;
        $this->cnpj = $empresas->cnpj;
        $this->email = $empresas->email;
        $this->sociedade = $empresas->sociedade;
        $this->nome_socios = $empresas->nome_socios;

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

    public function store()
    {
        //TRATAMENTO CNPJ

        $cnpj_tratado = null;
        if($this->cnpj)
        {
            $cnpj_tratado = str_replace('.', '', $this->cnpj);
            $cnpj_tratado = str_replace('-', '', $cnpj_tratado);
            $cnpj_tratado = str_replace('/', '', $cnpj_tratado);
        }

        Empresas::updateOrCreate(['id' => $this->empresas_id], [
            'name' => $this->name,
            'registro_marca' => $this->registro_marca,
            'cnpj' => $cnpj_tratado,
            'email' => $this->email,
            'sociedade' => $this->sociedade,
            'nome_socios' => $this->nome_socios,

        ]);


        $this->resetInputFields();

        session()->flash('message', 'Empresa registrada com sucesso');
        $this->closeModal();
    }
    public $confirmingItemDeletion = false;

    public function confirmingItemDeletion($id) //CONFIRMAÇÃO DE DELETE EMPRESAS
    {
        $this->confirmingItemDeletion = $id;
    }

    public function destroy($id) //DELETAR EMPRESAS
    {

        Empresas::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%'; // BUSCA DE EMPRESA POR NOME

        return view('livewire.empresas.empresas-create', [

            'empresas_retorno' => Empresas::where('name','like', $searchTerm)->paginate(5)

        ]);
    }
}
