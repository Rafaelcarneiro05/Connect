<div class="flex items-center justify-between">
    <button
        class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none hover:text-text-gray"
        wire:click="edit({{ $contact}})">
        {{__('More Information')}}
    </button>

    <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
            wire:click="confirmDeletion({{ $contact }})">
        {{ __('Delete')}}
    </button>

    <x-jet-dialog-modal wire:model="updating">
        <x-slot name="title"> {{ __('Details & Edit') }}</x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.name" value="{{ __('Name') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.name"
                                 autofocus/>
                    <x-jet-input-error for="contact.name" class="mt-2"/>

                </div>


                <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="contact.email" value="{{ __('E-mail') }}"/>
                        <x-jet-input type="text"
                                     class="mt-1 block w-full"
                                     wire:model.defer="contact.email"
                                     autofocus/>
                        <x-jet-input-error for="contact.email" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.password" value="{{ __('Password') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.password"
                                 autofocus/>
                    <x-jet-input-error for="contact.password" class="mt-2"/>

                </div>


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.phone" value="{{ __('Phone') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.phone"
                                 autofocus/>
                    <x-jet-input-error for="contact.phone" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.cep" value="{{ __('CEP') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.cep"
                                 autofocus/>
                    <x-jet-input-error for="contact.cep" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.endereco" value="{{ __('Endereço') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.endereco"
                                 autofocus/>
                    <x-jet-input-error for="contact.endereco" class="mt-2"/>

                </div>


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.bairro" value="{{ __('Bairro') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.bairro"
                                 autofocus/>
                    <x-jet-input-error for="contact.bairro" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.complemento" value="{{ __('Complemento') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.complemento"
                                 autofocus/>
                    <x-jet-input-error for="contact.complemento" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.cidade" value="{{ __('Cidade') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.cidade"
                                 autofocus/>
                    <x-jet-input-error for="contact.cidade" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.estado" value="{{ __('Estado') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.estado"
                                 autofocus/>
                    <x-jet-input-error for="contact.estado" class="mt-2"/>

                </div>




                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.birth_date" value="{{ __('Birth Date') }}"/>
                    <x-jet-input type="date"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.birth_date"
                                 autofocus/>
                    <x-jet-input-error for="contact.birth_date" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.bank_account" value="{{ __('Bank Account') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.bank_account"
                                 autofocus/>
                    <x-jet-input-error for="contact.bank_account" class="mt-2"/>

                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.cpf" value="{{ __('CPF') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.cpf"
                                 autofocus/>
                    <x-jet-input-error for="contact.cpf" class="mt-2"/>

                </div>


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="contact.sort_code" value="{{ __('Sort code') }}"/>
                    <x-jet-input type="text"
                                 class="mt-1 block w-full"
                                 wire:model.defer="contact.sort_code"
                                 autofocus/>
                    <x-jet-input-error for="contact.sort_code" class="mt-2"/>

                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('updating')" wire:loading.attr="disable">
                {{ __('Nevermind')}}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disable">
                {{ __('Save')}}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    <x-jet-confirmation-modal wire:model="destroying">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this account?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('destroying')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
