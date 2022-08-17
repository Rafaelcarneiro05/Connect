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




    public function render()
    {

        return view('livewire.recorrentes.recorrentes-create');

    }
}
