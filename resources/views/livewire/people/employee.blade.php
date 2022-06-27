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
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded my-3">Cadastrar Novo item</button>
    @if($isOpen)
        @include('livewire.people.employee-register')
    @endif


    <x-jet-section-border/>

    <div>

        <x-jet-action-section>
            <x-slot name="title">{{ __('Financial Brief') }} </x-slot>
            <x-slot name="description">{{ __('Cash Basis.')}}</x-slot>
            <x-slot name="content">
                    <div class="">
                        <div>
                            <label>Data Inicial</label>
                            <input wire:model="from" type="date">
                            <label>Data Final</label>
                            <input wire:model="to" type="date">
                        </div>
                        <div>
                            <label for="">Selecione a natureza:</label>
                            <select wire:model="cashflow">
                                <option value="">Todas</option>
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>
                    </div>


                        <div class="overflow-x-auto">
                            <table class="table-fixed w-full">
                                <thead>
                                    <tr>
                                        <th>Natureza</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @foreach ($financials_retorno as $financial)


                                        <tr>
                                            <td class="border border-slate-300">{{$financial->cashflow}} </td>
                                            <td class="border border-slate-300">{{'R$' .number_format($financial->value, 2,',', '.')}}</td>
                                            <td class="border border-slate-300">{{date('d/m/Y',strtotime($financial->data))}}</td>
                                            <td>
                                                <x-jet-button
                                                    class=""
                                                    wire:click="edit({{ $financial->id }})">
                                                    {{__('Edit')}}
                                                </x-jet-button>
                                                <x-jet-danger-button type="button"
                                                    class=""
                                                    wire:click="confirmingItemDeletion({{ $financial->id }})">
                                                    {{__('Delete')}}
                                                </x-jet-danger-button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div>
                                Entrada: {{'R$' .number_format($balanco_entr, 2,',', '.')}}
                            </div>
                            <div>
                                Saída: {{'R$' .number_format($balanco_saida, 2,',', '.')}}
                            </div>
                            <div>
                                Taxas: {{'R$' .number_format($balanco_taxa, 2,',', '.')}}
                            </div>

                            <div>
                                @php
                                if ( empty($cashflow) ) {
                                    echo 'Final: R$'.number_format($soma, 2,',', '.');
                                }
                                @endphp
                            </div>
                        </div>

            </x-slot>


        </x-jet-action-section>
            <!-- Delete User Confirmation Modal -->
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
    {{ $financials_retorno->links() }}

