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
                                <form wire:submit.prevent="store">

                                    <div class="px-4 py-5 bg-white sm:p-6 shadow  'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                        <div class="grid grid-cols-6 gap-6">

                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="">Moeda</label>
                                                <select wire:model="moeda" class="border-2 border-neutral-500 rounded">
                                                    <option disable selected >Selecione uma opção</option>
                                                    <option value="brl">BRL</option>
                                                    <option value="usdt">USDT</option>
                                                    <option value="euro">EURO</option>
                                                    <option value="bnb">BNB</option>
                                                    <option value="btc">BTC</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="col-span-6 sm:col-span-4">
                                                <div class="form-control">
                                                    <label> Selecione o tipo de operação:</label>
                                                    <select wire:model="cashflow" class="border-2 border-neutral-500 rounded">
                                                        <option selected>Selecione uma opção</option>
                                                        <option value="entrada">Entrada</option>
                                                        <option value="saida">Saída</option>
                                                    </select>
                                                    @error('cashflow')
                                                        <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Info</span>
                                                            <div>>
                                                                <span class="error">{{ $message }}</span>
                                                            </div>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="">Selecione a Empresa</label>
                                                <select wire:model="empresas_id" class="border-2 border-neutral-500 rounded">
                                                    <option disabled >Selecione uma opção</option>
                                                    <option value="">Nenhuma</option>
                                                        @foreach($empresas as $empresa)
                                                            <option  name="" value="{{$empresa->id}}"> {{$empresa->name}}</option>

                                                        @endforeach
                                                </select>
                                            </div>



                                            <br>

                                            <br>
                                            <div class="col-span-6 sm:col-span-4"wire:ignore>
                                                <div>
                                                    <label for="valor">Valor</label>

                                                        <input id="valor" type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="valor" onchange="@this.set('valor', this.value);">
                                                            @error('valor')
                                                                <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                                                    <span class="sr-only">Info</span>
                                                                    <div>>
                                                                        <span class="error">{{ $message }}</span>
                                                                    </div>
                                                                </div>
                                                            @enderror



                                                </div>
                                                <div>
                                                    <label for="">Fonte:</label>
                                                    <input wire:model.defer="fonte" type="text" class="border-2 border-neutral-500 rounded">
                                                </div>

                                                <div >
                                                    <label for="">Observação:</label>
                                                    <input wire:model.defer="observacao" type="text" class="border-2 border-neutral-500 rounded">
                                                </div>
                                                <div>
                                                    <div>
                                                        <label for="">Data</label>
                                                        <input wire:model.defer="data" type="date" class="border-2 border-neutral-500 rounded">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>




                                            @if($moeda == 'usdt')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração em dollar:</label>
                                                        <input wire:model.deboundance.800ms="fracao" onchange="@this.set('fracao', this.value);" type="text" class="mascara_fracao border-2 border-neutral-500 rounded">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Cotação do dia Dollar:</label>
                                                        <input type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="cotacaoEmBRL" onchange="@this.set('cotacaoEmBRL', this.value);">
                                                        <br>
                                                        Exemplo: 1 USD = R$ 5,00
                                                    </div>
                                                </div>
                                            @endif




                                            @if($moeda == 'euro')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração em EURO:</label>
                                                        <input wire:model.deboundance.800ms="fracao" onchange="@this.set('fracao', this.value);" type="text" class="mascara_fracao border-2 border-neutral-500 rounded">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Cotação do dia Euro:</label>
                                                        <input type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="cotacaoEmBRL" onchange="@this.set('cotacaoEmBRL', this.value);">
                                                        <br>
                                                        Exemplo: 1 € = 5,24 BRL
                                                    </div>
                                                    <br>
                                                </div>
                                            @endif



                                            @if($moeda == 'bnb')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração de Binance Coin BNB:</label>
                                                        <input wire:model.deboundance.800ms="fracao" onchange="@this.set('fracao', this.value);" type="text" class="mascara_fracao border-2 border-neutral-500 rounded">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Cotação BNB:</label>
                                                        <input type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="cotacaoEmBRL" onchange="@this.set('cotacaoEmBRL', this.value);">
                                                        <br>
                                                        Exemplo: 1 BNB = 1.420,17 BRL
                                                    </div>
                                                    <br>
                                                </div>
                                            @endif



                                            @if($moeda == 'btc')
                                                <div class="col-span-6 sm:col-span-4">
                                                    <div>
                                                        <label for="">Fração de Bitcoin BTC:</label>
                                                        <input type="text" class="mascara_fracao border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="fracao" onchange="@this.set('fracao', this.value);">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="">Cotação BTC:</label>
                                                        <input type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="cotacaoEmBRL" onchange="@this.set('cotacaoEmBRL', this.value);">
                                                        <br>
                                                        Exemplo: 1 BTC = 144.826,49 BRL
                                                    </div>
                                                    <br>
                                                </div>
                                            @endif


                                            @if($cashflow == 'saida')
                                                <div class="col-span-6 sm:col-span-4" id="divsaida">
                                                    <div class="col-span-6 sm:col-span-4">
                                                        <div class="form-control">


                                                            <div>
                                                                <label> Selecione a categoria:</label>
                                                                <select wire:model="saida" class="border-2 border-neutral-500 rounded">

                                                                    <option disabled>Selecione</option>
                                                                    <option value="despesas">Despesas</option>
                                                                    <option value="custos">Custos</option>
                                                                    <option value="imobilizados">Imobilizados</option>
                                                                </select>
                                                            </div>
                                                            <div >
                                                                <label for="descricao">Descrição do gasto:</label>
                                                            <div>
                                                                <textarea class="w-full h-20 border-2 border-neutral-500 rounded" name="" id="" cols="100" rows="15" wire:model.defer="descricao"></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="col-span-6 sm:col-span-4">
                                                <div>
                                                    <label for="taxa">Taxa de Transação:</label>
                                                    <input id="taxa" type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="taxa" onchange="@this.set('taxa', this.value);">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>



                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button wire:click="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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

                    <script type="text/javascript">
                        $(".value_valor").maskMoney({prefix:"R$ ",decimal:",", thousands:".", allowZero: true, allowNegative: false});
                        $(".value_valor_transacao").maskMoney({prefix:"R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});
                        $(".mascara_fracao").maskMoney({affixesStay: true, decimal:",", thousands:".", precision: 8, allowNegative: false,});
                    </script>

               <!-- conteudo da modal: FIM -->

            </div>




        </div>
    </div>
  </div>