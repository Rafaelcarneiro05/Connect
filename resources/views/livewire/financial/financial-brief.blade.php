<div>
    <x-jet-section-border/>

    <div>
        
        <x-jet-action-section>
            <x-slot name="title">{{ __('Financial Brief') }} </x-slot>
            <x-slot name="description">{{ __('Cash Basis.')}}</x-slot>
            <x-slot name="content">
                
                <form  class="form">
                    
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
                </form>
                
                <!--
                <x-jet-button wire:click="search">
                    {{ __('Search') }}
                </x-jet-button>
                -->
    

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
                                    @foreach ($financials_retorno as $financial)

                               
                                        <tr>
                                            <td>{{$financial->cashflow}} </td>
                                            <td>{{$financial->value}}</td>
                                            <td>{{$financial->descricao}}</td>
                                            <td>{{date('d/m/Y',strtotime($financial->created_at))}}</td>  
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <div wire>
                            Entrada: {{$balanco_entr}}
                            <div>
                                Saída: {{$balanco_saida}}
                            </div>
                            <div>
                                @php
                                if ( empty($cashflow) ) { 
                                    echo 'Final:'.$soma;
                                }    
                                @endphp
                            </div>
                        </div>
                         
            </x-slot>


        </x-jet-action-section>
        
    </div>
    {{ $financials_retorno->links() }}     
</div>