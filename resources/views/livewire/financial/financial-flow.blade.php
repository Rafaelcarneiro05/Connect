<div>
    <x-jet-section-border/>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title">{{ __('Cash Flow') }} </x-slot>
            <x-slot name="description">{{ __('Cash Basis.')}}</x-slot>
        </x-jet-section-title>

        
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="store">
    
                <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                    <div class="grid grid-cols-6 gap-6">
                    
                    <div class="col-span-6 sm:col-span-4">
                        <div class="form-control">
                            <label> Selecione o tipo de operação:</label>
                            <select wire:model="cashflow">
                                <option disabled >Selecione uma opção</option>
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>
                    </div>
                    @if ($cashflow == 'saida')

                    <div class="col-span-6 sm:col-span-4">
                        <div class="form-control">
                            <div>
                                <label> Selecione a categoria:</label>
                            </div>
                            <select wire:model="saida">
                                <option disabled >Selecione uma opção</option>
                                <option value="despesas">Despesas</option>
                                <option value="custos">Custos</option>
                                <option value="imobilizados">Imobilizados</option>
                            </select>
                            <div>
                                <label for="">Descrição do gasto:</label>
                                <div>
                                    <input wire:model='descricao' type="text">
                                </div>
                            </div>    
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="newValue.value" value="{{ __('Valor:') }}" />
                        <x-jet-input id="newValue.value" type="text" class="mt-1 block w-full" wire:model.defer="newValue.value" autofocus/>
                        <x-jet-input-error for="newValue.value" class="mt-2" />
                    </div>
                    @endif

                    @if ($cashflow == 'entrada')

                    
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="newValue.value" value="{{ __('Valor:') }}" />
                        <x-jet-input id="newValue.value" type="text" class="mt-1 block w-full" wire:model.defer="newValue.value" autofocus/>
                        <x-jet-input-error for="newValue.value" class="mt-2" />
                    </div>
                        
                    @endif
                </div>

            </form>
        </div>
        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">

            <x-jet-action-message class="mr-3" on="save">
                {{ __('Save Successfully') }}
            </x-jet-action-message>

            <x-jet-button wire:click="store">
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </div>
</div>