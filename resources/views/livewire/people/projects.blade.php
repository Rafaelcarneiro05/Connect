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
       
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded my-3">Cadastrar Novo Projeto</button>
    @if($isOpen)
        @include('livewire.people.projects-register')
    @endif
    @if($isOpen_equipe)
        @include('livewire.people.equipe')
    @endif   
    
    <x-jet-section-border/>
    <div>
        <x-jet-action-section>
            <x-slot name="title">{{ __('Projects Brief') }} </x-slot>
            <x-slot name="description">{{ __('Registro de Novos Projetos')}}</x-slot>
            <x-slot name="content">

                <div class="overflow-x-auto">
                    <input type="text"  class="form-control" placeholder="Search" wire:model="searchTerm" />                    
                    <table class="table-fixed w-full">
                        <thead>
                            <tr>
                                <th>Nome do Projeto</th>
                                <th>Descrição</th>
                                <th>Data de Início</th>
                                <th>Data do Termino</th>
                                <th>Equipe</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                                    
                            @foreach ($projects_retorno as $project)
                                <tr>
                                    <td class="border border-slate-300">{{$project->nome}} </td>
                                    <td class="border border-slate-300">{{$project->descricao}} </td>
                                    <td class="border border-slate-300">{{date('d/m/Y',strtotime($project->data_inicio))}}</td>
                                    <td class="border border-slate-300">{{date('d/m/Y',strtotime($project->data_termino))}}</td>                                   
                                    <td class="border border-slate-300">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($users_projects as $user_project)
                                            @php
                                                if($i>2)
                                                {
                                                    echo "...";
                                                    break;
                                                }
                                            @endphp
                                            @if ($user_project->project_id == $project->id)
                                                @php
                                                    $equipe_to = DB::table('users')->where('id', '=', $user_project->user_id)->first();
                                                    $nome_equipe = $equipe_to->name;
                                                    $i++;
                                                @endphp
                                                {{$nome_equipe}}<br>
                                            @endif                                        
                                        @endforeach                    
                                    </td>

                                    <td>
                                        <x-jet-button
                                            class=""
                                            wire:click="edit({{ $project->id }})">
                                            {{__('Edit')}}
                                        </x-jet-button>

                                        <x-jet-button
                                            class="bg-blue-400"
                                            wire:click="openModal_equipe({{ $project->id }})">
                                            {{__('Equipe')}}
                                        </x-jet-button>

                                                                            

                                        <x-jet-danger-button type="button"
                                            class=""
                                            wire:click="confirmingItemDeletion({{ $project->id }})">
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
        <!-- Delete Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingItemDeletion">
            <x-slot name="title">
                {{ __('Apagar?') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Você tem certeza que deseja apagar esse projeto?') }}

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
    {{ $projects_retorno->links() }}
</div>


