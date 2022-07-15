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
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded my-3">Cadastrar Nova Pessoa</button>
    @if($isOpen)
        @include('livewire.people.employee-register')
    @endif


    <x-jet-section-border/>

    <div>

        <x-jet-action-section>
            <x-slot name="title">{{ __('Employee Brief') }} </x-slot>
            <x-slot name="description">{{ __('Registro de Novos Colaboradores')}}</x-slot>
            <x-slot name="content">
                    

                        <div class="overflow-x-auto">
                            <input type="text"  class="form-control" placeholder="Search" wire:model="searchTerm" />
                            <table class="table-fixed w-full">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Pix</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    
                                    @foreach ($employees_retorno as $user)


                                        <tr>
                                            <td class="border border-slate-300">{{$user->name}} </td>
                                            <td class="border border-slate-300">{{$user->email}} </td>
                                            <td class="border border-slate-300">{{$user->pix}} </td>
                                           
                                            <td>
                                                <x-jet-button
                                                    class=""
                                                    wire:click="edit({{ $user->id }})">
                                                    {{__('Edit')}}
                                                </x-jet-button>
                                                <x-jet-danger-button type="button"
                                                    class=""
                                                    wire:click="confirmingItemDeletion({{ $user->id }})">
                                                    {{__('Delete')}}
                                                </x-jet-danger-button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    {{ $employees_retorno->links() }}
</div>

