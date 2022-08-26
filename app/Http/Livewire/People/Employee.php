<?php

namespace App\Http\Livewire\People;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

//  MODELS UTILIZADAS
use App\Models\User;
use App\Models\UserProject;


class Employee extends Component
{
    //ATRIBUTOS TELA DE PESQUISA
    use WithPagination;

    public $searchTerm;
    public $confirmingItemDeletion = false;
 
    //ATRIBUTOS TELA DE CADASTRO/EDIÇÃO
    public $isOpen = 0;
    public $user_id;

    public $nome;
    public $email;
    public $senha;
    public $cep;
    public $endereco;
    public $bairro;
    public $complemento;
    public $cidade;
    public $estado;
    public $role ='user';
    public $telefone;
    public $data_nasc;
    public $cpf;
    public $conta;
    public $codigo_bank;
    public $rg;
    public $pix;
    public $escolaridade;
    public $cnpj;
    public $nacionalidade;
    public $estado_civil = 'solteiro';
    public $sexo = 'masculino';
    public $tamanho_roupa;
    public $data_admissao;
    public $tipo_contrato = 'colaborador';
    public $habilidade;
    public $valor_hora;

    public $informacoes_usuarios = [];


    public function create() //abrir modal para cadastro ----
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function edit($id)   //abrir modal para edicao ----
    {
        $user = User::find($id); 
        
        $this->user_id = $id;

        $this->nome = $user->name;
        $this->email = $user->email;
        $this->cep = $user->cep;
        $this->endereco = $user->endereco;
        $this->bairro = $user->bairro;
        $this->complemento = $user->complemento;
        $this->cidade = $user->cidade;
        $this->estado = $user->estado;
        $this->role = $user->role;
        $this->telefone = $user->phone;
        $this->data_nasc= $user->birth_date;
        $this->cpf = $user->cpf;
        $this->conta = $user->bank_account;
        $this->codigo_bank = $user->sort_code;
        $this->rg = $user->rg;
        $this->pix = $user->pix;
        $this->escolaridade = $user->escolaridade;
        $this->cnpj = $user->cnpj;
        $this->nacionalidade = $user->nacionalidade;
        $this->estado_civil = $user->estado_civil;
        $this->sexo = $user->sexo;
        $this->tamanho_roupa = $user->tamanho_roupa;
        $this->data_admissao = $user->admission_date;
        $this->tipo_contrato = $user->tipo_contrato;
        $this->habilidade = $user->habilidade;
        $this->valor_hora = $user->valor_hora;

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

    private function resetInputFields()//reseta os campos
    {
        $this->reset();
    }     

    public function store()  //PROCESSAMENTO do cadastrar ou editar: updateOrCreate
    {       
        if($this->user_id)//VERIFICA SE É UPDATE OU CREATE E ADICIONA HASH NA SENHA
        {
            if(!$this->senha)
            {
                $this->informacoes_usuarios = User::orderBy('name', 'asc')->get();
                foreach($this->informacoes_usuarios as $informacao_usuario)
                {
                    if($informacao_usuario->id == $this->user_id)
                    {
                        $this->senha = $informacao_usuario->password;
                    }
                }  
            }
            else
            {
                $this->senha = Hash::make($this->senha);
            }
        }
        else
        {
            $this->senha = Hash::make($this->senha);
        }       
        
        
        //converte valor do formato 15.120,00 para 15120.00
        $valor_tratado = str_replace('R$', '', $this->valor_hora);
        $valor_tratado = str_replace('.', '', $valor_tratado);
        $valor_tratado = str_replace(',', '.', $valor_tratado);

        //EDIÇÃO OU CRIAÇÃO updateOrCreate
        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->nome,
            'email' => $this->email,
            'password' => $this ->senha,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'complemento' => $this->complemento,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'role' => $this->role,
            'phone' => $this->telefone,
            'birth_date' => $this->data_nasc,
            'cpf' => $this->cpf,
            'bank_account' => $this->conta,
            'sort_code' => $this->codigo_bank,
            'rg' => $this->rg,
            'pix' => $this->pix,
            'escolaridade' => $this->escolaridade,
            'cnpj' => $this->cnpj,
            'nacionalidade' => $this->nacionalidade,
            'estado_civil' => $this->estado_civil,
            'sexo' => $this->sexo,
            'tamanho_roupa' => $this->tamanho_roupa,
            'admission_date' =>	$this->data_admissao,
            'tipo_contrato' =>	$this->tipo_contrato,
            'habilidade' =>	$this->habilidade,
            'valor_hora' =>	$valor_tratado,
            ]);

        $this->resetInputFields();

        session()->flash('message', 'Pessoa registrado com sucesso.');

        $this->closeModal();     
    }

    public function confirmingItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function destroy($id)
    {
        UserProject::where([['user_id', '=', $id]])->delete();//apaga os projetos relacionados ao user em questão
        
        User::find($id)->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item deletado com sucesso.');
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';//busca
        return view('livewire.people.employee', [
            'employees_retorno' => User::where('name', 'like', $searchTerm)->paginate(10)
        ]);
    }

}
