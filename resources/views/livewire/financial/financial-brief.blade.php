<div>
    <x-jet-section-border/>

    <div>
        <x-jet-action-section>
            <x-slot name="title">{{ __('Financial Brief') }} </x-slot>
            <x-slot name="description">{{ __('Cash Basis.')}}</x-slot>
            <x-slot name="content">
                
                <form  class="form" wire:model="search">
                    
                    <div>
                        <label for="">Data Inicial</label>
                        <input type="date">
                        <label for="">Data Final</label>
                        <input type="date">
                    </div>
                    
                    <div>
                        <label for=""></label>
                        <select name="" id="">
                            <option disabled value="">Selecione a Natureza</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </div>
                </form>
                
                <x-jet-button wire:click="search">
                    {{ __('Search') }}
                </x-jet-button>
        
    

                        <div class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th>Natureza</th>
                                        <th>Valor</th>
                                        <th>Descrição</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @foreach ($financials as $financial)

                               
                                        <tr>
                                            <td>{{$financial->cashflow}} </td>
                                            <td>{{$financial->value}}</td>
                                            <td>{{$financial->descricao}}</td>
                                            <td>{{$financial->created_at}}</td>  
                                        </tr>

                                    @endforeach
                                </tbody
                            </table>
                        </div>
            </x-slot>
        </x-jet-action-section>
    </div>
</div>