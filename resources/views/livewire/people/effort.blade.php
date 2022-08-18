<div>
    @if (session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
            <div>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
            </div>
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded my-3"> Novo registro de ponto</button>
    @if($isOpen)
        @include('livewire.people.effort-register')
    @endif

    <x-jet-action-section>
        <x-slot name="title">{{ __('Effort Register') }} </x-slot>
        <x-slot name="description">{{ __('Registro Esforços')}}</x-slot>
        <x-slot name="content">
            <div class="overflow-x-auto">
                <div>
                    <label><strong>Selecione o período para obter o total de horas</strong> </label><br>

                    <label>De:</label>
                    <input wire:model="from" type="date">

                    <label>Até:</label>
                    <input wire:model="to" type="date"><br>

                    <label>Projeto</label>
                    <select wire:model="filtro_projeto">
                        <option value="">Todos</option>
                        @foreach ($projetos as $projeto)
                            <option value="{{$projeto->id}}">{{$projeto->nome}}</option>
                        @endforeach                        
                    </select><br>

                    @if ($this->from and $this->to)
                        <label><strong>Total de Horas Trabalhadas: {{App\Http\Livewire\People\Effort::contarHoras($this->from, $this->to, $this->filtro_projeto)}}</strong></label><br>
                    @endif
                </div>

                <table class="table-fixed w-full">
                    <div class="col-span-6 sm:col-span-4">                                      
                    </div> 
                    <thead>
                        <tr>
                            <th>Inicio</th>
                            <th>Fim</th>
                            <th>Projeto</th>
                            <th>Trabalhadas</th>
                        </tr>                            
                    </thead>
                    
                    <tbody align="center">
                        @foreach ($efforts_retorno as $effort)                           
                            <tr>
                                <td class="border border-slate-300">{{date('d/m/Y H:i:s',strtotime($effort->inicio))}}</td>
                                
                                <td class="border border-slate-300">
                                    @if (!$effort->fim) 
                                    <strong>Em Aberto...</strong>                                                
                                    @else
                                        {{date('d/m/Y H:i:s',strtotime($effort->fim))}}
                                    @endif
                                </td>

                                <td class="border border-slate-300">
                                    @php
                                        $projeto_to = DB::table('projects')->where('id', '=', $effort->projeto_id)->first();
                                    @endphp
                                    {{$projeto_to->nome}}                          
                                </td>

                                <td class="border border-slate-300">
                                    @if ($effort->fim)
                                        <label>{{App\Http\Livewire\People\Effort::diffHoras($effort->inicio, $effort->fim)}}</label>
                                    @else
                                        <label>{{App\Http\Livewire\People\Effort::diffHoras($effort->inicio)}}</label>
                                    @endif
                                    
                                </td>
                                
                                <td>
                                    @if ($effort->fim == NULL)<!-- Verifica de o ponto ainda está aberto -->
                                        <x-jet-button
                                            class=""
                                            wire:click="fecharPonto()">
                                            {{__('Finalizar Ponto')}}
                                        </x-jet-button>
                                    @endif                                    

                                    <x-jet-danger-button type="button"
                                        class=""
                                        wire:click="confirmingItemDeletion({{ $effort->id }})">
                                        {{__('Delete')}}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <x-jet-dialog-modal wire:model="confirmingItemDeletion">
                    <x-slot name="title">
                        {{ __('Apagar?') }}
                    </x-slot>
        
                    <x-slot name="content">
                        {{ __('Você tem certeza que deseja apagar esse item?') }}
        
                    </x-slot>
        
                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$set('confirmingItemDeletion', false)" wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-jet-secondary-button>
        
                        <x-jet-danger-button class="ml-3" wire:click="destroy({{ $confirmingItemDeletion }})" wire:loading.attr="disabled">
                            {{ __('Apagar') }}
                        </x-jet-danger-button>
                    </x-slot>
                </x-jet-dialog-modal>
            </div>
            {{ $efforts_retorno->links() }}
        </x-slot> 
    </x-jet-action-section>

</div>


