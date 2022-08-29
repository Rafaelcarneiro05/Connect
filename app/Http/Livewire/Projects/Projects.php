<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

//Models Utilizadas
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
    public $tamanho = 0;
    public $teste;

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

    public function edit(int $id)//abrir modal para edicao
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

    public function substrwords($descricao, $maxchar=35, $end='...')
    {
        if(strlen($descricao)>$maxchar || $descricao == '' )
        {
            $words = preg_split('/\s/', $descricao);
            $output = '';
            $i = 0;
            while (1)
            {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar)
                {
                    break;
                }
                else
                {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        }
        else
        {
            $output = $descricao;
        }
        return $output;
    }

    public function subnome($nome)
    {
        $subnome = explode(" ", $nome);
        $output = '';
        if(count($subnome)>1)
        {
            if($subnome[1] == 'de' or $subnome[1] == 'da' or $subnome[1] == 'do' or $subnome[1] == 'De' or $subnome[1] == 'Da' or $subnome[1] == 'Do')
            {
                $output .= $subnome[0].' '.$subnome[2];
                return $output;
            }
            else
            {
                $output .= $subnome[0].' '.$subnome[1];
                return $output;
            }
        }
        else
        {
            return $subnome[0];
        }
    }

    public function equipe($id)
    {
        $i = 0;
        foreach ($this->users_projects as $user_project)
        {
            if ($user_project->project_id == $id)
            {
                $i++;
                $equipe_to = DB::table('users')->where('id', '=', $user_project->user_id)->first();
                if($i>3)
                {
                    echo "...";
                    break;
                }
                echo($equipe_to->name), '<br>';
            }
        }
    }

    public function render()
    {
        $this->multi_equipe_todos = User::orderBy('name', 'asc')->get();//consulta todos os usuarios
        $this->users_projects = UserProject::orderBy('user_id', 'asc')->get();//consulta as relações entre users e projects


        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.projects.projects',[
            'projects_retorno' => Project::where('nome', 'like', $searchTerm)->paginate(10)
        ]);
    }
}
