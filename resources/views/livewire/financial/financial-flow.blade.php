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
                            <select wire:model="cashflow" id="idcashflow">
                                <option disabled >Selecione uma opção</option>
                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>
                            </select>
                        </div>
                    </div>
                   
                    @if($cashflow == 'saida')
                        <div class="col-span-6 sm:col-span-4" id="divsaida">
                            <div class="col-span-6 sm:col-span-4">
                                <div class="form-control">
                                    <div>
                                        <label> Selecione a categoria:</label>
                                        <select wire:model.defer="saida">
                                            <option disabled >Selecione uma opção</option>
                                            <option value="despesas">Despesas</option>
                                            <option value="custos">Custos</option>
                                            <option value="imobilizados">Imobilizados</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="descricao">Descrição do gasto:</label>
                                        <div>
                                            <input wire:model.defer='descricao' type="text">
                                        </div>
                                        <br>
                                        <div>
                                            <label for="valor">Valor</label>
                                            <input id="valor" type="text" class="value_valor" wire:model.deboundance.800ms="valor" onchange="@this.set('valor', this.value);" /> 
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    @endif
                    

                    
                    @if($cashflow == 'entrada')
                    <div class="col-span-6 sm:col-span-4" id="diventrada">
                        <div class="form-control">
                            <div>
                                <div>
                                    <label for="">Data</label>
                                    <input wire:model.defer="data" type="date">
                                </div>
                            </div>
                            <br>
                            <div>
                                <label for="">Moeda</label>
                                <select wire:model="moeda"  name="" id="">
                                    <option value="brl">BRL</option>
                                    <option value="usdt">USDT</option>
                                    <option value="euro">EURO</option>
                                    <option value="bnb">BNB</option>
                                    <option value="btc">BTC</option>
                                    
                                </select>
                            </div>



                            @if($moeda == 'brl')
                                <div>
                                    <label for="valor">Valor</label>
                                    <input id="valor" type="text" class="value_valor" wire:model.deboundance.800ms="valor" onchange="@this.set('valor', this.value);" /> 
                                </div>
                                <br>
                                <div>
                                    <label for="">Fonte:</label>
                                    <input wire:model.defer="fonte" type="text">
                                    @error('fonte') <span class="error">{{ $message }}</span> @enderror
                                </div> 
                                <br>
                                <div>
                                    <label for="">Observação:</label>
                                    <input wire:model.defer= "observacao" type="text" name="" id="">
                                    @error('observacao') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <br>
                                <div>
                                    <label for="">Taxa de Transação:</label>
                                    <input wire:model.defer="taxa" type="text">
                                </div>
                            @endif



                            @if($moeda == 'usdt')
                                <div>
                                    <label for="">Fração em dollar:</label>
                                    <input wire:model.defer="fracao" type="text">
                                </div>
                                <br>
                                <div>
                                    <label for="">Cotação do dia Dollar:</label>
                                    <input wire:model.defer="cotacaoEmBRL" type="text"> 
                                    <br>
                                    Exemplo: 1 USD = 5 BRL
                                </div>
                                <br>
                                <div>
                                    <label for="">Fonte:</label>
                                    <input wire:model.defer="fonte" type="text">
                                </div> 
                                <br>
                                <div>
                                    <label for="">Observação:</label>
                                    <input wire:model.defer="observacao" type="text" name="" id="">
                                </div>
                                <br>
                                <div>
                                    <label for="">Taxa de Transação:</label>
                                    <input wire:model.defer="taxa" type="text">
                                </div>
                            @endif

                            @if($moeda == 'euro')
                                <div>
                                    <label for="">Fração em EURO:</label>
                                    <input wire:model.defer="fracao" type="text">
                                </div>
                                <br>
                                <div>
                                    <label for="">Cotação do dia Euro:</label>
                                    <input wire:model.defer="cotacaoEmBRL"type="text"> 
                                    <br>
                                    Exemplo: 1 € = 5,24 BRL
                                </div>
                                <br>
                                <div>
                                    <label for="">Fonte:</label>
                                    <input wire:model.defer="fonte" type="text">
                                </div> 
                                <br>
                                <div>
                                    <label for="">Observação:</label>
                                    <input wire:model.defer="observacao" type="text" name="" id="">
                                </div>
                                <br>
                                <div>
                                    <label for="">Taxa de Transação:</label>
                                    <input wire:model.defer="taxa" type="text">
                                </div>
                            @endif



                            @if($moeda == 'bnb')
                                    <div>
                                        <label for="">Fração de Binance Coin BNB:</label>
                                        <input wire:model.defer="fracao" type="text">
                                    </div>
                                    <br>
                                    <div>
                                        <label for="">Cotação BNB:</label>
                                        <input wire:model.defer="cotacaoEmBRL" type="text"> 
                                        <br>
                                        Exemplo: 1 BNB = 1.420,17 BRL
                                    </div>
                                    <br>
                                    <div>
                                        <label for="">Fonte:</label>
                                        <input wire:model.defer="fonte" type="text">
                                    </div> 
                                    <br>
                                    <div>
                                        <label for="">Observação:</label>
                                        <input wire:model.defer="observacao" type="text" name="" id="">
                                    </div>
                                    <br>
                                    <div>
                                        <label for="">Taxa de Transação:</label>
                                        <input wire:model.defer="taxa" type="text">
                                    </div>
                            @endif



                            @if($moeda == 'btc')

                                <div>
                                    <label for="">Fração de Bitcoin BTC:</label>
                                    <input wire:model.defer="fracao" type="text">
                                </div>
                                <br>
                                <div>
                                    <label for="">Cotação BNB:</label>
                                    <input wire:model.defer="cotacaoEmBRL" type="text"> 
                                    <br>
                                    Exemplo: 1 BTC = 144.826,49 BRL
                                </div>
                                <br>
                                <div>
                                    <label for="">Fonte:</label>
                                    <input wire:model.defer="fonte" type="text">
                                </div> 
                                <br>
                                <div>
                                    <label for="">Observação:</label>
                                    <input wire:model.defer="observacao" type="text" name="" id="">
                                </div>
                                <br>
                                <div>
                                    <label for="">Taxa de Transação:</label>
                                    <input wire:model.defer="taxa" type="text">
                                </div>
                            @endif




                        </div>     
                    </div>
                    @endif

                </div>

                 <div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">

                    <x-jet-action-message class="mr-3" on="save">
                        {{ __('Save Successfully') }}
                    </x-jet-action-message>

                    
                    <x-jet-button>
                        {{ __('Save') }}
                    </x-jet-button>
                 </div>
            

        </div>

            </form>
        </div>
       
    </div>
</div>

<script type="text/javascript">   
    //máscara de dinheiro #valor_investido
    $(".value_valor").maskMoney({prefix: "R$ ", affixesStay: false, decimal:",", thousands:".", allowZero: true, allowNegative: false});
</script>


    
    
        
    
        
    


    
