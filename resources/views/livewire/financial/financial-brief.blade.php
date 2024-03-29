<div>
    @php

        $message_effetive_clicked = session()->get('message_effetive_clicked');
    @endphp
    @if ($message_effetive_clicked)
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
        <div class="flex">
            <div>
                <p class="text-sm">{!! $message_effetive_clicked !!}</p>
            </div>
        </div>
    </div>
    @php
        session()->forget($message_effetive_clicked);
    @endphp

    @endif
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
        @include('livewire.financial.financial-flow')
    @endif




    <div class="bg-white border-2 p-8" >

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
                <div class="col-span-6 sm:col-span-4">
                    <label for="">Selecione a Empresa</label>
                    <select wire:model="empresa" class="border-2 border-neutral-500 rounded">
                        <option disabled >Selecione uma opção</option>
                        <option value="">Nenhuma</option>
                            @foreach($empresas as $empresa)
                                <option value="{{$empresa->id}}"> {{$empresa->name}}</option>

                            @endforeach
                    </select>
                    <div>
                        <button wire:click="pdf">PDF</button></a>

                    </div>
                </div>

            <div class="table w-full">
                <table >
                    <thead align="left">
                        <tr>
                            <th>Data</th>
                            <th>Natureza</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Fonte</th>
                            <th>Empresa</th>
                            <th>Moeda</th>
                            <th>Cotação</th>
                            <th>Fração</th>
                            <th>Taxa</th>
                            <th>Observação</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-400" "align="left">
                        @if ($financials_retorno)


                            @foreach ($financials_retorno as $financial)
                            @php
                                $nome_empresa = '';
                                if(!is_null($financial->empresas_id)){
                                    $empresa_to = DB::table('empresas')->where('id', '=', $financial->empresas_id)->first();
                                    $nome_empresa = $empresa_to->name;
                                }

                            @endphp
                                <tr >

                                    <td class="border border-slate-400">{{date('d/m/Y',strtotime($financial->data))}}</td>
                                    <th class="border border-slate-400">{{$financial->cashflow}} </th>
                                    <td class="border border-slate-400">{{$financial->saida}} </td>
                                    <td class="border border-slate-400">{{$financial->descricao}} </td>
                                    <td class="border border-slate-400">{{$financial->fonte}} </td>
                                    <td class="border border-slate-400">{{$nome_empresa}}</td>
                                    <td class="border border-slate-400">{{$financial->moeda}} </td>
                                    <td class="border border-slate-400">{{'R$' .number_format($financial->cotacaoEmBRL, 2,',', '.')}} </td>
                                    <td class="border border-slate-400">{{$financial->fracao}} </td>
                                    <td class="border border-slate-400">{{$financial->taxa}} </td>
                                    <td class="border border-slate-400">{{$financial->observacao}} </td>
                                    <td class="border border-slate-400">{{'R$' .number_format($financial->value, 2,',', '.')}}</td>
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

                        @else
                        <tr>
                            <td colspan="2">Nenhum registro encontrado</td>
                        </tr>
                        @endif



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
                    <strong>
                        @php
                        if ( empty($cashflow) ) {
                            echo 'Final: R$: '.number_format($soma, 2,',', '.');
                        }
                        @endphp
                    </strong>
                </div>
                <hr>

                <!--CALCULO USDT -->
                <div>
                    @if ($this->fracao_usdt_entr)
                        Total USDT Entrada:{{$fracao_usdt_entr}}
                    @endif
                </div>


                <div>
                    @if ($this->fracao_usdt_saida)
                       Total USDT Saida:{{$fracao_usdt_saida}}
                    @endif
                </div>


                <div>
                    <strong>
                        @php
                        if ( empty($cashflow) ) {
                            echo 'Final: USDT: ' .number_format($soma_usdt, 8,',', '.');
                        }
                        @endphp
                    </strong>
                </div>
                <hr>


                <!--CALCULO EURO -->
                <div>
                    @if ($this->fracao_euro_entr)
                        Total EURO Entrada:{{$fracao_euro_entr}}
                    @endif
                </div>


                <div>
                    @if ($this->fracao_euro_saida)
                        Total EURO Saida:{{$fracao_euro_saida}}
                    @endif
                </div>


                <div>
                    <strong>
                        @php
                        if ( empty($cashflow) ) {
                            echo 'Final: EURO: '.number_format($soma_euro, 8,',', '.');
                        }
                        @endphp
                    </strong>
                </div>
                <hr>


                <!--CALCULO BTC -->
                <div>
                    @if ($this->fracao_btc_entr)
                        Total BTC Entrada:{{$fracao_btc_entr}}
                    @endif
                </div>


                <div>
                    @if ($this->fracao_btc_saida)
                        Total BTC Saida:{{$fracao_btc_saida}}
                    @endif
                </div>


                <div>
                    <strong>
                        @php
                        if ( empty($cashflow) ) {
                            echo 'Final: BTC: '.number_format($soma_btc, 8,',', '.');
                        }
                        @endphp
                    </strong>
                </div>
                <hr>

                <!--CALCULO BNB -->
                <div>
                    @if ($this->fracao_bnb_entr)
                        Total BNB Entrada:{{$fracao_bnb_entr}}
                    @endif
                </div>


                <div>
                    @if ($this->fracao_bnb_saida)
                        Total BNB Saida:{{$fracao_bnb_saida}}
                    @endif
                </div>


                <div>
                    <strong>
                        @php
                        if ( empty($cashflow) ) {
                            echo 'Final: BNB: '.number_format($soma_bnb, 8,',', '.');
                        }
                        @endphp
                    </strong>
                </div>
            </div>




        </div>

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