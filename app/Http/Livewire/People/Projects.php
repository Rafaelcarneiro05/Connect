<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use Livewire\WithPagination;

//Models Ultilizadas
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;


class Projects extends Component
{
    //ATRIBUTOS TELA PESQUISA
    use WithPagination;

    public $searchTerm;
    public $confirmingItemDeletion = false;
    public $multi_equipe_todos;
    public $users_projects = [];

    //ATRIBUTOS TELA CADASTRO/EDIÇÃO
    public $isOpen = 0;
    public $isOpen_equipe = 0;
    public $nome;
    public $descricao;
    public $data_inicio;
    public $data_termino;
    public $project_id;

    //ATRIBUTOS MODAL EQUIPE
    public $projeto_nome;
    public $multi_equipe_escolhidos = [];
    public $projeto_id;   
    
    public function create()//abrir modal para cadastro 
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)//abrir modal para edicao
    {
        $project = Project::find($id); 
        
        $this->project_id = $id;
        $this->nome = $project->nome;
        $this->descricao = $project->descricao;
        $this->data_inicio = $project->data_inicio;
        $this->data_termino = $project->data_termino;

        $this->openModal();
    }

    private function resetInputFields()//reseta os campos
    {
        $this->reset();
    }  

    public function openModal()//abre modal de cadastro
    {
        $this->isOpen = true;
    }

    public function closeModal()//fecha modal de cadastro
    {
        $this->isOpen = false;
    }

    public function openModal_equipe($id)//abre modal equipe
    {
        $this->isOpen_equipe = true;
        
        $project = Project::find($id);
        $this->projeto_nome = $project->nome;
        $this->projeto_id = $project->id;       

        $users_ = User::pluck('id')->toArray();
        $this->multi_equipe_escolhidos = array_fill_keys($users_, false);//inicialmente todos os chekbox estao desmarcados

        foreach($this->multi_equipe_escolhidos as $key => $value)//atribuir true para as checkbox que serao marcadas
        {
                $verifica_user_no_projeto = UserProject::where([['user_id', '=', $key], ['project_id', '=', $this->projeto_id]])->first();
                if($verifica_user_no_projeto)
                {
                    $this->multi_equipe_escolhidos[$key] = true;
                }
        }
        
    }

    public function closeModal_equipe()//fecha modal equipe
    {
        $this->isOpen_equipe = false;
    }

    public function save_equipe()//processamento modal equipe
    {
        UserProject::where([['project_id', '=', $this->projeto_id]])->delete();//Deleta todos primeiro

        foreach($this->multi_equipe_escolhidos as $key => $escolhidos)//Salva as informações
        {
            if($escolhidos)
            {
                if($escolhidos == true)
                {
                    UserProject::create(['user_id' => $key, 'project_id' => $this->projeto_id]);
                }
                else
                {
                    UserProject::create(['user_id' => $escolhidos, 'project_id' => $this->projeto_id]);
                }
            }   
        }
        $this->isOpen_equipe = false;        
    }

    public function store() //Processamento modal de cadastro/edicao
    {       
        Project::updateOrCreate(['id' => $this->project_id],[
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'data_inicio' => $this->data_inicio,
            'data_termino' => $this->data_termino,
        ]);

        $this->resetInputFields();
        session()->flash('message', 'Projeto registrado com sucesso.');
        $this->closeModal(); 
    }

    public function confirmingItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function destroy($id)//Delete
    {
        UserProject::where([['user_id', '=', $id]])->delete();

        Project::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Projeto deletado com sucesso.');
    }

    public function render()
    {
        $this->multi_equipe_todos = User::orderBy('name', 'asc')->get();//consulta todos os usuarios
        $this->users_projects = UserProject::orderBy('user_id', 'asc')->get();//consulta as relações entre users e projects
   
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.people.projects',[
            'projects_retorno' => Project::where('nome', 'like', $searchTerm)->paginate(10)
        ]);
    }
}
