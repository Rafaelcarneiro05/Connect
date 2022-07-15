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
                                <form> <!-- (FORMULARIO COM CAMPOS) wire:submit.prevent="store"-->

                                    <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                        <div class="grid grid-cols-6 gap-6">     

                                        
                                    <!-- campos -->
                                    <div class="col-span-6 sm:col-span-4">
                                             <div class="form-control">
                                                <label> Nome:</label>
                                                <input wire:model.defer="nome" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Email:</label>
                                                <input wire:model.defer="email" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                             <div class="form-control">
                                                <label> Senha:</label>
                                                <input wire:model.defer="senha" type="password" class="border-2 border-neutral-500 rounded" value="">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Cep:</label>
                                                <input wire:model.deboundance.800ms="cep" onchange="@this.set('cep', this.value);" type="text" class="mask_cep border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Endereço:</label>
                                                <input wire:model.defer="endereco" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                     <div class="col-span-6 sm:col-span-4">
                                             <div class="form-control">
                                                <label> Bairro:</label>
                                                <input wire:model.defer="bairro" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Complemento:</label>
                                                <input wire:model.defer="complemento" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Cidade:</label>
                                                <input wire:model.defer="cidade" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Estado:</label>
                                                <input wire:model.defer="estado" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                     </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Perfil:</label>
                                                <select wire:model="role" class="border-2 border-neutral-500 rounded pppppp"> 
                                                    <option disabled >Selecione uma opção</option>
                                                    <option value="admin">Administrador</option>
                                                    <option value="user">Colaborador</option>
                                                </select>
                                            </div>
                                    </div>


                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Telefone:</label>
                                                <input wire:model.deboundance.800ms="telefone" onchange="@this.set('telefone', this.value);" type="text" class="mask_telefone border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                     <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Data de Nascimento:</label>
                                                <input wire:model.defer="data_nasc" type="date" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                             <div class="form-control">
                                                <label> CPF:</label>
                                                <input wire:model.deboundance.800ms="cpf" onchange="@this.set('cpf', this.value);" type="text" class="mask_cpf border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                             <div class="form-control">
                                                <label> Conta Bancaria:</label>
                                                <input wire:model.defer="conta" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Codigo do Banco:</label>
                                                <input wire:model.defer="codigo_bank" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> RG:</label>
                                                <input wire:model.defer="rg" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Pix:</label>
                                                <input wire:model.defer="pix" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Escolaridade:</label>
                                                <input wire:model.defer="escolaridade" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> CNPJ:</label>
                                                <input wire:model.deboundance.800ms="cnpj" onchange="@this.set('cnpj', this.value);" type="text" class="mask_cnpj border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Nacionalidade:</label>
                                                <input wire:model.defer="nacionalidade" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Estado Civil:</label>
                                                <select wire:model="estado_civil" class="border-2 border-neutral-500 rounded pppppp"> 
                                                    <option disabled >Selecione uma opção</option>
                                                    <option value="solteiro">Solteiro</option>
                                                    <option value="casado">Casado</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Sexo:</label>
                                                <select wire:model="sexo" class="border-2 border-neutral-500 rounded pppppp"> 
                                                    <option disabled >Selecione uma opção</option>
                                                    <option value="masculino">Masculino</option>
                                                    <option value="feminino">Feminino</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                            <div class="form-control">
                                                <label> Tamanho da Roupa (Uniforme):</label>
                                                <input wire:model.defer="tamanho_roupa" type="text" class="border-2 border-neutral-500 rounded">
                                            </div>
                                    </div>
                                </form>
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
                <!-- máscara nos campos -->
                <script type="text/javascript">                    

                    $(".mask_cpf").mask('999.999.999-99');
                    $(".mask_cep").mask('99999-999');
                    $(".mask_telefone").mask('(99) 99999-9999');
                    $(".mask_cnpj").mask('99.999.999/9999-99');

               </script>
               <!-- conteudo da modal: FIM -->
            </div>



        </div>
    </div>
  </div>