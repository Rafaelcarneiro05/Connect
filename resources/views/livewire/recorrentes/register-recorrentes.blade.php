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


                                    <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                        <div class="flex flex-col">
                                            <div class="form-control gap-8 flex flex-col" >
                                                <div class="w-full">
                                                    <label>Categoria:</label>
                                                    <select name="" id="" wire:model.defer="categoria" >
                                                        <option disabled>Selecione uma categoria</option>
                                                        <option value="despesas">Despesas</option>
                                                        <option value="custos">Custos</option>
                                                        <option value="imobilizados">Imobilziados</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="">Data</label>
                                                    <input wire:model.defer="data" type="date" class="border-2 border-neutral-500 rounded">
                                                </div>

                                                <div class="w-full">
                                                    <div >
                                                        <label for="descricao">Descrição do gasto:</label>
                                                    <div>
                                                        <textarea class="w-full h-20 border-2 border-neutral-500 rounded" name="" id="" cols="100" rows="15" wire:model.defer="descricao"></textarea>
                                                    </div>
                                                </div>


                                                <div class="w-full">
                                                    <label for="">Valor:</label>
                                                    <input id="value" type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="value" onchange="@this.set('value', this.value);">
                                                </div>


                                                <div class="w-full">
                                                    <label for="">Fonte</label>
                                                    <input id="" type="text" wire:model.defer="fonte">
                                                </div>


                                                <div class="w-full">
                                                    <label for="">Observação:</label>
                                                    <div>
                                                        <textarea class="w-full h-20 border-2 border-neutral-500 rounded" name="" id="" cols="100" rows="15" wire:model.defer="observacao"></textarea>
                                                    </div>
                                                </div>


                                                <div class="w-full">
                                                    <label for="taxa">Taxa de Transação:</label>
                                                    <input id="taxa" type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="taxa" onchange="@this.set('taxa', this.value);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
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
                <script type="text/javascript">
                    $(".value_valor").maskMoney({prefix: "R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});
                    $(".value_valor_transacao").maskMoney({prefix: "R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});
                    $(".mascara_fracao").maskMoney({affixesStay: true, decimal:",", thousands:"", allowZero: false, allowNegative: false});
               </script>
               <!-- conteudo da modal: FIM -->
            </div>
        </div>
    </div>
  </div>