<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 block mr-auto ml-auto">




                <!-- CONTEUDO DA MODAL -->
                <div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form> <!-- wire:submit.prevent="store"-->

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




                                            <br>
                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="">Moeda</label>
                                                <select wire:model="moeda">
                                                    <option disabled >Selecione uma opção</option>
                                                    <option value="brl">BRL</option>
                                                    <option value="usdt">USDT</option>
                                                    <option value="euro">EURO</option>
                                                    <option value="bnb">BNB</option>
                                                    <option value="btc">BTC</option>

                                                </select>
                                            </div>





                                                @if($moeda == 'brl')
                                                    <div class="col-span-6 sm:col-span-4">
                                                        <div>
                                                            <label for="valor">Valor</label>
                                                            <input id="valor" type="text" class="value_valor" wire:model.deboundance.800ms="valor" onchange="@this.set('valor', this.value);" />
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label >Fonte:</label>
                                                            <input wire:model.defer="fonte" type="text">
                                                        </div>
                                                        <br>
                                                        <div >
                                                            <label >Observação:</label>
                                                            <input wire:model.defer="observacao" type="text">
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label >Taxa de Transação:</label>
                                                            <input wire:model.defer="taxa" type="text" class="value_valor_transacao">
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($moeda == 'usdt')
                                                    <div class="col-span-6 sm:col-span-4">
                                                        <div>
                                                            <label for="">Fração em dollar:</label>
                                                            <input wire:model.defer="fracao" type="text" class="mascara_fracao">
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="">Cotação do dia Dollar:</label>
                                                            <input wire:model.defer="cotacaoEmBRL" type="text" class="value_valor">
                                                            <br>
                                                            Exemplo: 1 USD = R$ 5,00
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="">Fonte:</label>
                                                            <input wire:model.defer="fonte" type="text">
                                                        </div>
                                                        <br>
                                                        <div >
                                                            <label for="">Observação:</label>
                                                            <input wire:model.defer="observacao" type="text">
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="">Taxa de Transação:</label>
                                                            <input wire:model.defer="taxa" type="text">
                                                        </div>
                                                    </div>
                                                @endif

                                            @if($moeda == 'euro')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração em EURO:</label>
                                                        <input wire:model.defer="fracao" type="text" class="mascara_fracao">
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
                                                        <input wire:model.defer="observacao" type="text">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Taxa de Transação:</label>
                                                        <input wire:model.defer="taxa" type="text">
                                                    </div>
                                                </div>
                                            @endif



                                            @if($moeda == 'bnb')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração de Binance Coin BNB:</label>
                                                        <input wire:model.defer="fracao" type="text" class="mascara_fracao">
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
                                                        <input wire:model.defer="observacao" type="text">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Taxa de Transação:</label>
                                                        <input wire:model.defer="taxa" type="text">
                                                    </div>
                                                </div>
                                            @endif



                                            @if($moeda == 'btc')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração de Bitcoin BTC:</label>
                                                        <input wire:model.defer="fracao" type="text" class="mascara_fracao">
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
                                                </div>
                                            @endif

                                        </div>


                                            @if($cashflow == 'saida')
                                                <div class="col-span-6 sm:col-span-4" id="divsaida">
                                                    <div class="col-span-6 sm:col-span-4">
                                                        <div class="form-control">
                                                            <div>
                                                                <div>
                                                                    <label for="">Data</label>
                                                                    <input wire:model.defer="data" type="date">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div>
                                                                <label> Selecione a categoria:</label>
                                                                <select wire:model.defer="saida">
                                                                    <option disabled >Selecione uma opção</option>
                                                                    <option value="despesas">Despesas</option>
                                                                    <option value="custos">Custos</option>
                                                                    <option value="imobilizados">Imobilizados</option>
                                                                </select>
                                                            </div>
                                                            <div >
                                                                <label for="descricao">Descrição do gasto:</label>
                                                            <div>
                                                                <input wire:model.defer='descricao' type="text">
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        <!--ENTRADA --> <!--ENTRADA --> <!--ENTRADA --> <!--ENTRADA --> <!--ENTRADA -->


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

                                                </div>
                                            </div>
                                            @endif




                        </div>

                </div>
                <!--<script type="text/javascript">
                    $(".value_valor").maskMoney({prefix: "R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});
                    $(".value_valor_transacao").maskMoney({prefix: "R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});
                    $(".mascara_fracao").maskMoney({affixesStay: true, decimal:",", thousands:"", allowZero: false, allowNegative: false});
               </script> -->


               <!-- conteudo da modal: FIM -->




            </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </span>

        </div>

      </div>
    </div>
  </div>