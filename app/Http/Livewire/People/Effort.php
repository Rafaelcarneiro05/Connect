<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//Models Ultilizadas
use App\Models\User;
use App\Models\Efforts;
use App\Models\Project;
use App\Models\UserProject;

class Effort extends Component
{   
    //ATRIBUTOS TELA DE PESQUISA
    use WithPagination;
    public $searchTerm;
    public $confirmingItemDeletion;
    public $isOpen = 0;
    public $ponto_aberto = 0;
    public $projetos;
    public $usuarios;
    public $esforcos;
    public $users_projects = [];
    public $from;
    public $to;

    //ATRIBUTOS TELA DE CADASTRO/EDIÇÃO
    public $esforco_id;
    public $projeto_id = 1;
    public $hora;
    public $logado;
    public $projetos_usuario;
    


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
     
    public function confirmingItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }
    
    private function resetInputFields()//reseta os campos
    {
        $this->reset();
    }     
    
    public function destroy($id)//apaga o esforço atual
    {
        Efforts::where([['id', '=', $id]])->delete();
        
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }
    
    public function store() //Processamento do registro de novo ponto
    {
        Efforts::updateOrCreate(['id' => $this->esforco_id], 
        [
            'inicio' => $this->hora,
            'projeto_id' => $this->projeto_id,
            'usuario_id' => $this->logado,
        ]);

        $this->resetInputFields();
        session()->flash('message', 'Ponto registrado com sucesso.');
        $this->closeModal();
        $this->ponto_aberto = true; 
    }

    public function fecharPonto()//fechar ponto
    {   
        Efforts::where([['usuario_id', '=', $this->logado],['fim', '=', NULL]])->update(['fim' => $this->hora]);
        $this->ponto_aberto = false;
    }

    public function create() //abrir modal para registrar novos pontos
    { 
        if($this->ponto_aberto)
        {
            session()->flash('message', 'Feche o ponto em aberto antes de iniciar um novo.');
        }
        else
        {
            $this->resetInputFields();
            $this->openModal();
        }
        $this->logado = Auth::user()->id;
        $this->projetos_usuario = UserProject::where('user_id', '=', $this->logado)->get();

    }
    
    public function render()
    {
        $this->logado = Auth::user()->id;//consultao usuario logado
        $this->hora = Carbon::now()->setTimezone('America/Sao_Paulo');//consulta a hora atual
        $this->projetos = Project::orderBy('nome', 'asc')->get();//consulta todos os projetos               
        $this->usuarios = User::orderBy('name', 'asc')->get();//consulta todos os usuarios               
        $this->esforcos = Efforts::orderBy('inicio', 'asc')->get();//consulta todos os esforços
        $this->users_projects = UserProject::orderBy('user_id', 'asc')->get();
        
        $where = [];
        
        if ($this->to) 
        {
            $to_explodido = explode('/', $this->to);
            $to_explodido = array_reverse($to_explodido);
            $to_explodido = implode('-', $to_explodido);

            $where[] = ['created_at', '<=',   $to_explodido];
            dd($this->from, $this->to);
        }

        
        $searchTerm = '%'.$this->searchTerm.'%';
        return view('livewire.people.effort', [
            'efforts_retorno' => Efforts::where('inicio', 'like', $searchTerm)->paginate(10)
        ]);        
    } 
}