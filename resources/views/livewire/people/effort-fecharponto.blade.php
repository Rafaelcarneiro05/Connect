<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 block mr-auto ml-auto">

                <!-- CONTEUDO DA MODAL -->
                <div>
                    <label class="font-bold">Fechar Mês</label>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form> <!-- (FORMULARIO COM CAMPOS) -->

                            <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <label class="font-bold" >Selecione a data inicial e final</label><br>
                                <label>Data inicial:</label>
                                <input wire:model="from_fechar" type="date"
                                    @if ($this->from_fechar && $this->to_fechar)
                                        readonly
                                    @endif
                                ><br>

                                <label>Data Final:</label>
                                <input wire:model="to_fechar" type="date"
                                    @if ($this->from_fechar && $this->to_fechar)
                                        readonly
                                    @endif
                                >

                                @if ($this->from_fechar && $this->to_fechar) 
                                <table class="table-fixed w-full">
                                    <div class="col-span-6 sm:col-span-4">                                      
                                    </div> 
                                    <thead>
                                        <tr>
                                            <th class="">Colaborador</th>
                                            <th class="">Horas Feitas</th>
                                            <th class="">Valor por Hora</th>
                                            <th class="">Total</th>
                                        </tr>                            
                                    </thead>                                    
                                    <tbody align="center">
                                        @foreach ($colaboradores as $colaborador)                           
                                            <tr>
                                                <td class="border border-slate-300">{{$colaborador->name}}</td>

                                                <td class="border border-slate-300">
                                                    <label>{{App\Http\Livewire\People\EffortAdmin::horasFeitas($colaborador->id)}}</label>
                                                </td>

                                                <td class="border border-slate-300">
                                                    {{'R$ ' .number_format($colaborador->valor_hora, 2,',', '.')}}  
                                                </td>

                                                <td class="border border-slate-300">
                                                    {{'R$ ' .number_format(App\Http\Livewire\People\EffortAdmin::total(App\Http\Livewire\People\EffortAdmin::horasFeitas($colaborador->id), $colaborador->valor_hora), 2,',', '.')}}
                                                    
                                                </td>
                                            
                                                <td>
                                                    <button wire:click="folhaPonto({{$colaborador->id}})" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                        Folha de Ponto
                                                    </button> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                    <div class="font-bold w-full text-right">Total Geral: {{'R$ ' .number_format($this->total_geral, 2,',', '.')}}</div>
                                @endif
                            <!-- campos -->                                                          
                     </div>
                    <div class="col-span-6 sm:col-span-6 bg-gray-50 gap-4 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button wire:click="closeModalPonto()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                            </button>
                        </span>
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="lembreteSalario({{$this->total_geral}})" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Gerar Lembrete
                            </button>
                        </span>                              
                    </div>
                </div>
            </div>   
        </div>  
    </div>
</div>