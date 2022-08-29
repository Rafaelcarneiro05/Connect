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
    public $confirmingItemDeletion;
    public $isOpen = 0;
    public $ponto_aberto = 0;
    public $projetos;
    public $from;
    public $to;
    public $filtro_projeto;
    public $projetos_usuario;

    //ATRIBUTOS TELA DE CADASTRO/EDIÇÃO
    public $esforco_id;
    public $hora;
    public $logado;
    public $projeto_id;
    public $campo_nulo;
    
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
        $destruir = DB::table('efforts')->where([['id', '=', $id]])->first();
        if($destruir->fim == NULL)
        {
            Efforts::where([['id', '=', $id]])->delete();
            $this->ponto_aberto = false;
        }
        else
        {
            Efforts::where([['id', '=', $id]])->delete();
        }
        
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }
    
    public function store() //Processamento do registro de novo ponto
    {
        if($this->projeto_id == NULL)
        {
            $this->campo_nulo = true;
        }
        else
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
    }

    public function fecharPonto()//fechar ponto
    {   
        $this->hora = Carbon::now()->setTimezone('America/Sao_Paulo');
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
    }

    public function secondsToHours($seg) //transorma segundos em horas
    {
        $total_horas[0] = str_pad(intval($seg / 3600) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[1] = str_pad(intval(($seg - ($total_horas[0] * 3600)) / 60) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[2] = str_pad(intval($seg % 60) , 2 , '0' , STR_PAD_LEFT);

        $horas = implode(':',  $total_horas);
        return $horas;
    }

    public function diffHoras($inicio, $fim = 'nulo')//conta as horas de um esforço
    {
        if($fim == 'nulo')
        {
            $fim = Carbon::now()->setTimezone('America/Sao_Paulo');
        }
        $hora_inicial = Carbon::createFromFormat('Y-m-d H:i:s', $inicio);
        $hora_final = Carbon::createFromFormat('Y-m-d H:i:s', $fim);
        $segundos_trabalhadas = $hora_final->diffInSeconds($hora_inicial);

        return Effort::secondsToHours($segundos_trabalhadas);
    }

    public function contarHoras($inicio, $fim, $projeto)//conta as horas em determinado periodo e projeto
    {
        $fim = Carbon::create($fim);
        $fim = $fim->addDays(1);
        if($projeto)
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim],['usuario_id', '=', $this->logado],['projeto_id', '=', $projeto]])->get();
        }
        else
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim],['usuario_id', '=', $this->logado]])->get();
        }
        
        $total_segundos = 0;
        foreach($horas as $hora)//soma todos os segundos
        {
            $data_inicial = Carbon::createFromFormat('Y-m-d H:i:s', $hora->inicio);
            $data_final = Carbon::createFromFormat('Y-m-d H:i:s', $hora->fim);
            $segundos_trabalhados = $data_final->diffInSeconds($data_inicial);
            $total_segundos += $segundos_trabalhados;
        }
        //tranforma os segundos em horas, minutos e segundos
        return Effort::secondsToHours($total_segundos);
    }

    public function render()
    {
        $this->logado = Auth::user()->id;//consultao usuario logado
        $this->hora = Carbon::now()->setTimezone('America/Sao_Paulo');//consulta a hora atual              
        $this->projetos_usuario = UserProject::where('user_id', '=', $this->logado)->get();//consulta os projetos relacionados ao user logado
        $this->projetos = Project::orderBy('id', 'asc')->get();

        //FILTROS DE BUSCA
        $filtros = [];
        if($this->filtro_projeto)
        {
            $filtros[] = ['projeto_id', '=', $this->filtro_projeto];
        }               
        if ($this->from) 
        {
            $from = Carbon::create($this->from);
            $filtros[] = ['inicio', '>=', $from];
        }
        if ($this->to) 
        {
            $to = Carbon::create($this->to);
            $to = $to->addDays(1);
            $filtros[] = ['inicio', '<',   $to];
        }
        $filtros[] = ['usuario_id', '=', $this->logado];

        return view('livewire.people.effort', [
            'efforts_retorno' => Efforts::where($filtros)->orderBy('id', 'desc')->paginate(10)
        ]);        
    } 
}