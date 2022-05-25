<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use App\Models\User;
use Livewire\Component;

class ContactsNew extends Component
{

    public $cep;
    public $endereco;
    public $bairro;
    public $complemento;
    public $cidade;
    public $estado;
    public User $newUser;
    public $totalSteps = 2;
    public $currentStep = 1;

    public function updatedCep()
    {
        $ch = curl_init("https://viacep.com.br/ws/{$this->cep}/json/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        //dd($result);

        $this->endereco = $result->logradouro;
        $this->bairro = $result->bairro;
        $this->complemento = $result->complemento;
        $this->cidade = $result->localidade;
        $this->estado = $result->uf;
    }

   

    public function mount(User $user)
    {
        $this->newUser = $user;
        $this->currentStep = 1;
        $this->withAttributes = [];
    }

    public function increaseStep()
    {
        //dd($this->newUser);

        if ($this->currentStep == 1) {
            $this->validate([
                'newUser.name' => 'required|string',
                'newUser.email' => 'required|email',
                'newUser.password' => 'required|min:6',
                'newUser.phone' => 'required|string|min:8',
                'newUser.birth_date' => 'required|date',
                'cep' => 'required|min:8',
                'endereco' => 'required',
                'bairro' => 'required',
                'complemento' => 'nullable',
                'cidade' => 'required',
                'estado' => 'required',

            ]);
        }
        
        $this->currentStep++;

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
        //dd($this->newUser->password);
    }

    public function decreaseStep()
    {
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function store()
    {
        $this->validate([
            'newUser.cpf' => 'required|string',
            'newUser.bank_account' => 'required|string',
            'newUser.sort_code' => 'required|string',
        ]);
        $this->newUser->cep = $this->cep;
        $this->newUser->endereco=$this->endereco;
        $this->newUser->bairro=$this->bairro;
        $this->newUser->complemento=$this->complemento;
        $this->newUser->cidade=$this->cidade;
        $this->newUser->estado=$this->estado;
        $this->newUser->save();

        $this->newUser = new User();

        $this->emit(event: 'created');

        $this->currentStep = 1;
    }
    


    public function render()
    {
        return view(view: 'contacts.contact-new');
    }
    protected function rules()
    {
        return [
            'newUser.name' => 'required|string',
            'newUser.email' => 'required|email',
            'newUser.phone' => 'required|string|min:8',
            'newUser.password' => 'required|string|min:6|max:12',
            'newUser.birth_date' => 'required|date',
            'newUser.cpf' => 'required|string',
            'newUser.bank_account' => 'required|string',
            'newUser.sort_code' => 'required|string',
            'cep' => 'required|min:8',
            'endereco' => 'required',
            'bairro' => 'requirede',
            'complemento' => 'nullable',
            'cidade' => 'required',
            'estado' => 'required',

        ];
    }
}
