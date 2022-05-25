<div>
    <x-jet-section-border/>

    <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title">{{ __('Register New Employee') }} </x-slot>
            <x-slot name="description">{{ __('All fields are mandatory.')}}</x-slot>
        </x-jet-section-title>
        
        {{--STEP 1 --}}


        <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="store">

            <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                @if ($currentStep == 1)
                
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.name" value="{{ __('Name') }}" />
                    <x-jet-input id="newUser.name" type="text" class="mt-1 block w-full" wire:model.defer="newUser.name" autofocus/>
                    <x-jet-input-error for="newUser.name" class="mt-2" />
                </div>
        
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.email" value="{{ __('Email') }}" />
                    <x-jet-input id="newUser.email" type="text" class="mt-1 block w-full" wire:model.defer="newUser.email" autofocus/>
                    <x-jet-input-error for="newUser.email" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.password" value="{{ __('Password') }}" />
                    <x-jet-input id="newUser.password" type="text" class="mt-1 block w-full" wire:model.defer="newUser.password" autofocus/>
                    <x-jet-input-error for="newUser.password" class="mt-2" />
                </div>
                
        
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.phone" value="{{ __('Phone') }}" />
                    <x-jet-input id="newUser.phone" type="text" class="mt-1 block w-full" wire:model.defer="newUser.phone" autofocus/>
                    <x-jet-input-error for="newUser.phone" class="mt-2" />
                </div>
    
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="cep" value="{{ __('CEP') }}" />
                    <x-jet-input id="cep" type="text" class="mt-1 block w-full" wire:model.lazy="cep" autofocus/>
                    <x-jet-input-error for="cep" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="endereco" value="{{ __('Endereço') }}" />
                    <x-jet-input id="endereco" type="text" class="mt-1 block w-full" wire:model.defer="endereco" autofocus/>
                    <x-jet-input-error for="endereco" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="bairro" value="{{ __('Bairro') }}" />
                    <x-jet-input id="bairro" type="text" class="mt-1 block w-full" wire:model.defer="bairro" autofocus/>
                    <x-jet-input-error for="bairro" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="complemento" value="{{ __('Complemento') }}" />
                    <x-jet-input id="complemento" type="text" class="mt-1 block w-full" wire:model.defer="complemento" autofocus/>
                    <x-jet-input-error for="complemento" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="cidade" value="{{ __('Cidade') }}" />
                    <x-jet-input id="cidade" type="text" class="mt-1 block w-full" wire:model.defer="cidade" autofocus/>
                    <x-jet-input-error for="cidade" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="estado" value="{{ __('Estado') }}" />
                    <x-jet-input id="estado" type="text" class="mt-1 block w-full" wire:model.defer="estado" autofocus/>
                    <x-jet-input-error for="estado" class="mt-2" />
                </div>

                
    
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.birth_date" value="{{ __('Birth Date') }}" />
                    <x-jet-input id="newUser.birth_date" type="date" class="mt-1 block w-full" wire:model.defer="newUser.birth_date" autofocus/>
                    <x-jet-input-error for="newUser.birth_date" class="mt-2" />
                </div>

                @endif
                
    
                {{-- step 2 --}}
    
                @if ($currentStep == 2)
                    
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.cpf" value="{{ __('CPF') }}" />
                    <x-jet-input id="newUser.cpf" type="text" class="mt-1 block w-full" wire:model.defer="newUser.cpf" autofocus/>
                    <x-jet-input-error for="newUser.cpf" class="mt-2" />
                </div>
    
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.bank_account" value="{{ __('Bank Account') }}" />
                    <x-jet-input id="newUser.bank_account" type="text" class="mt-1 block w-full" wire:model.defer="newUser.bank_account" autofocus/>
                    <x-jet-input-error for="newUser.bank_account" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="newUser.sort_code" value="{{ __('Sort Code') }}" />
                    <x-jet-input id="newUser.sort_code" type="text" class="mt-1 block w-full" wire:model.defer="newUser.sort_code" autofocus/>
                    <x-jet-input-error for="newUser.sort_code" class="mt-2" />
                </div>
    
                @endif
                </div>
            </div>
    
            
            
        
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <x-jet-action-message class="mr-3" on="created">
                    {{ __('Contact created') }}
                </x-jet-action-message>
                
                @if ($currentStep == 2)
                <x-jet-button type="button" wire:click="decreaseStep">
                    {{ __('Back') }}
                </x-jet-button>
                @endif    
                
                
                @if ($currentStep == 1)
                    <x-jet-button type="button" wire:click="increaseStep">
                    {{ __('Next') }}
                    </x-jet-button>
                @endif

                @if ($currentStep == 2)
                <x-jet-button wire:click="store">
                    {{ __('Save') }}
                </x-jet-button>
                @endif    
               
            </div>
            
        </form> 

        </div>
        
    </div>
    
</div>
