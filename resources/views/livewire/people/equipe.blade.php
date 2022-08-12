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
            <h1><strong>{{$projeto_nome}}</strong></h1>
            <br>
            <div class="col-span-6 sm:col-span-4">
              <div class="form-control">
                <label>Equipe:</label>               

                @foreach ($multi_equipe_todos as $membro)
                  <div>
                    <input type="checkbox" id="id_{{$membro->id}}" name="multi_equipe_escolhidos[]" wire:model.defer="multi_equipe_escolhidos.{{$membro->id}}" value="{{$membro->id}}">
                    <label for="id_{{$membro->id}}">{{$membro->name}}</label>
                  </div>                    
                @endforeach                
              </div>
            </div>

            <div><!-- botões -->
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                      <button wire:click.prevent="save_equipe()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Save
                      </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                      <button wire:click="closeModal_equipe()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancel
                      </button>
                    </span>
                </div>
            </div>
          </div>
      </div>
  </div>
</div>