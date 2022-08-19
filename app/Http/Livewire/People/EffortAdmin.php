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

class EffortAdmin extends Component
{
    public $teste = 'testecontroler';

    //ATRIBUTOS TELA DE PESQUISA
    use WithPagination;
    public $confirmingItemDeletion;
    public $isOpen = 0;
    public $isOpenPonto = 0;
    public $projetos;
    public $usuarios;
    public $from;
    public $to;
    public $filtro_projeto;
    public $filtro_usuario;

    //ATRIBUTOS TELA DE CADASTRO/EDIÇÃO
    public $esforco_id;
    public $inicio;
    public $fim;
    public $projeto_id;
    public $usuario_id;
    public $campo_nulo = 0;
    public $hora;
    public $logado;


    public function openModal()
    {
        $this->isOpen = true;
    }

    public function openModalPonto()
    {
        $this->isOpenPonto = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function closeModalPonto()
    {
        $this->isOpenPonto = false;
    }
     
    public function confirmingItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }
    
    private function resetInputFields()//reseta os campos
    {
        $this->reset();
    }

    public function edit($id)   //abrir modal para edicao
    {
        $effort = Efforts::find($id); 
        
        $this->esforco_id = $id;

        $this->inicio = $effort->inicio;
        $this->fim = $effort->fim;
        $this->projeto_id = $effort->projeto_id;
        $this->usuario_id = $effort->usuario_id;        

        $this->openModal();
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
        if($this->inicio == NULL or $this->fim == NULL or $this->projeto_id == NULL or $this->usuario_id == NULL)
        {
            $this->campo_nulo = true;
        }
        else
        {
            Efforts::updateOrCreate(['id' => $this->esforco_id], 
            [
                'inicio' => $this->inicio,
                'fim' => $this->fim,
                'projeto_id' => $this->projeto_id,
                'usuario_id' => $this->usuario_id,
            ]);

            $this->resetInputFields();
            session()->flash('message', 'Ponto registrado com sucesso.');
            $this->closeModal();
        }
    }

    public function create() //abrir modal para registrar novos pontos
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function fecharPonto() //abrir modal para registrar novos pontos
    {
        $this->openModalPonto();
    }

    public function diffHoras($inicio, $fim = 'nulo')
    {
        if($fim == 'nulo')
        {
            $fim = Carbon::now()->setTimezone('America/Sao_Paulo');
        }
        $hora_inicial = Carbon::createFromFormat('Y-m-d H:i:s', $inicio);
        $hora_final = Carbon::createFromFormat('Y-m-d H:i:s', $fim);
        $segundos_trabalhadas = $hora_final->diffInSeconds($hora_inicial);

        $total_horas[0] = str_pad(intval($segundos_trabalhadas / 3600) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[1] = str_pad(intval(($segundos_trabalhadas - ($total_horas[0] * 3600)) / 60) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[2] = str_pad(intval($segundos_trabalhadas % 60) , 2 , '0' , STR_PAD_LEFT);

        $hours = implode(':',  $total_horas);//coloca numa string no fomrato H:i:s     
        return $hours;
    }

    public function contarHoras($inicio, $fim, $usuario, $projeto)//conta as horas em relação a determinado periodo, projeto e usuario
    {
        $fim = Carbon::create($fim);
        $fim = $fim->addDays(1);

        //verifica quais filtros serão aplicados
        if($projeto and $usuario)
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim],['usuario_id', '=', $usuario],['projeto_id', '=', $projeto]])->get();
        }
        elseif($projeto)
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim],['projeto_id', '=', $projeto]])->get();
        }
        elseif($usuario)
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim],['usuario_id', '=', $usuario]])->get();
        }
        else
        {
            $horas = DB::table('efforts')->where([['inicio', '>=', $inicio],['fim', '<', $fim]])->get();
        }

        $total_segundos = 0;
        foreach($horas as $hora)
        {
            $data_inicial = Carbon::createFromFormat('Y-m-d H:i:s', $hora->inicio);
            $data_final = Carbon::createFromFormat('Y-m-d H:i:s', $hora->fim);
            $segundos_trabalhados = $data_final->diffInSeconds($data_inicial);
            $total_segundos += $segundos_trabalhados;
        }
        //tranforma os segundos em horas, minutos e segundos
        $total_horas[0] = str_pad(intval($total_segundos / 3600) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[1] = str_pad(intval(($total_segundos - ($total_horas[0] * 3600)) / 60) , 2 , '0' , STR_PAD_LEFT);
        $total_horas[2] = str_pad(intval($total_segundos % 60) , 2 , '0' , STR_PAD_LEFT);

        $hours = implode(':',  $total_horas);//coloca numa string no fomrato H:i:s     
        return $hours;
    }

    public function render()
    {
        $this->projetos = Project::orderBy('id', 'asc')->get();
        $this->usuarios = User::orderBy('id', 'asc')->get();

        //FILTROS DE BUSCA      
        $filtros = [];
        if($this->filtro_usuario)
        {
            $filtros[] = ['usuario_id', '=', $this->filtro_usuario];
        }               
        if($this->filtro_projeto)
        {
            $filtros[] = ['projeto_id', '=', $this->filtro_projeto];
        }               
        if ($this->from) 
        {
            $from = Carbon::create($this->from);
            $filtros[] = ['inicio', '>=',  $from];
        }
        if ($this->to) 
        {
            $to = Carbon::create($this->to);
            $to = $to->addDays(1);
            $filtros[] = ['fim', '<',  $to];            
        }

        return view('livewire.people.effort-admin', [
            'efforts_retorno_admin' => Efforts::where($filtros)->orderBy('id', 'desc')->paginate(10)
        ]);        
    }
}
