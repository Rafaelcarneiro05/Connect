<?php

namespace App\Http\Livewire\Financial;

use Livewire\Component;
use App\Models\Recorrentes;
use Livewire\WithPagination;

class CalendarRegister extends Component
{
    use WithPagination;

    //TELA DE REGISTRO
    public $categoria;
    public $descricao;
    public $value;
    public $data;
    public $recorrente_id;
    public $event_id;
    public $color;
    //Resetar campos
    private function resetInputFields()
    {
        $this->reset();
    }

    public static function lembreteSalario($value)//criar lembrete do sálario
    {
        Recorrentes::create([

            'categoria' => 'custos',
            'descricao' => 'Salário',
            'value' => $value,
            'data' => date('Y-m-25'),
            'color' => '#62019b',
        ]);
    }

    public static function lembrenteAdmissao($name, $data)//criar lembrete de 3 meses 
    {
        Recorrentes::create([
            'categoria' => 'imobilizados',
            'descricao' => '3 meses '. $name,
            'value' => 0,
            'data' => $data,
            'color' => '#62019b'
        ]);
    }

    //Cadastrar pagamento
    public function save()
    {

        //Tratamento value -> R$ 1,00 = 1.00
        $valor_tratado = str_replace('.', '', $this->value);
        $valor_tratado = str_replace(',', '.', $valor_tratado);
        $valor_tratado = str_replace('R$', '', $valor_tratado);
        $valor_tratado = str_replace(' ', '', $valor_tratado);


        Recorrentes::create([

            'categoria' => $this->categoria,
            'descricao' => $this->descricao,
            'value' => $valor_tratado,
            'data' => $this->data,
            'color' => $this->color
        ]);


        $this->resetInputFields();


        $this->dispatchBrowserEvent('closeModalCreate', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    //Deletar Pagamento

    public function delete()
    {

        Recorrentes::findOrFail($this->recorrente_id)->delete();
        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function update()
    {
        //Tratamento value -> R$ 1,00 = 1.00

        $valor_tratado = str_replace('.', '', $this->value);
        $valor_tratado = str_replace(',', '.', $valor_tratado);
        $valor_tratado = str_replace('R$', '', $valor_tratado);
        $valor_tratado = str_replace(' ', '', $valor_tratado);


        Recorrentes::findOrFail($this->recorrente_id)->update([
            'categoria' => $this->categoria,
            'descricao' => $this->descricao,
            'value' => $valor_tratado,
            'data' => $this->data,
            'color' => $this->color
        ]);

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function effect()
    {

        return redirect()->route('financial-brief');
    }
    public function render()
    {
        return view('livewire.financial.calendar-register');
    }
}
