<?php

namespace App\Http\Livewire\Recorrentes;

use App\Http\Livewire\Empresas\EmpresasCreate;
use App\Models\Recorrentes;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Financial;
use App\Http\Livewire\Financial\FinancialBrief;
use Illuminate\Support\Facades\Redirect;

class RecorrentesCreate extends Component
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
        $efective = FinancialBrief::openModal();

        return redirect()->route('financial-flow', compact('efetive'));
    }
    public function render()
    {

        return view('livewire.recorrentes.recorrentes-create');
    }
}
