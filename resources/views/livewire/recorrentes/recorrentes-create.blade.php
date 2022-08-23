<div wire:ignore>
    <!-- CREATE modal --><!-- CREATE modal --><!-- CREATE modal --><!-- CREATE modal -->
    <div>

                <div id="modalCreate" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button id="closeModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="py-6 px-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Cadastrar Pagamento</h3>
                                <form wire:submit.prevent="save" class="space-y-6" action="#">
                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Categoria da saída:</label>
                                        <select name="" id="categoria" wire:model.defer="categoria" >
                                            <option disabled>Selecione uma categoria</option>
                                            <option value="despesas">Despesas</option>
                                            <option value="custos">Custos</option>
                                            <option value="imobilizados">Imobilziados</option>
                                        </select>
                                    <div>
                                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">DATA</label>
                                        <input type="date" wire:model.defer="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div>
                                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Selecione a cor:</label>
                                        <input type="color" name="" id="" wire:model.defer="color">
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrição do Gasto</label>
                                        <div>
                                            <textarea class="w-full h-20 border-2 border-neutral-500 rounded" name="" id="title" cols="100" rows="15" wire:model.defer="descricao"></textarea>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Valor:</label>
                                        <input id="value" type="text" class="value_valor border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="value" onchange="@this.set('value', this.value);">
                                    </div>


                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-black shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Save
                                        </button>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <!-- EDIT modal --><!-- EDIT modal --><!-- EDIT modal --><!-- EDIT modal --><!-- EDIT modal -->
    <div>

        <div id="modalEdit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button id="closeModalEdit" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="py-6 px-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Editar Pagamento</h3>
                        <form wire:submit.prevent="update" class="space-y-6" action="#">
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Categoria da saída:</label>
                                <select name="" id="categoria" wire:model.defer="categoria" >
                                    <option disabled>Selecione uma categoria</option>
                                    <option value="despesas">Despesas</option>
                                    <option value="custos">Custos</option>
                                    <option value="imobilizados">Imobilziados</option>
                                </select>
                            <div>
                                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">DATA</label>
                                <input type="date" wire:model.defer="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            </div>

                            <div>
                                <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Selecione a cor:</label>
                                <input type="color" name="" id="" wire:model.defer="color">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrição do Gasto</label>
                                <div>
                                    <textarea class="w-full h-20 border-2 border-neutral-500 rounded" name="" id="title" cols="100" rows="15" wire:model.defer="descricao"></textarea>
                                </div>
                            </div>

                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Valor:</label>
                                <input id="value" type="text" class="value_valor1 border-2 border-neutral-500 rounded" wire:model.deboundance.800ms="value" onchange="@this.set('value', this.value);">
                            </div>


                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Salvar
                                </button>


                                <button wire:click.prevent="effect" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Efetivar
                                </button>
                                    <button wire:click.prevent="delete" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Apagar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <x-jet-action-section>
        <x-slot name="title">{{ __('Gastos Rcorrentes') }} </x-slot>
        <x-slot name="description">{{ __('Registro de Gastos Recorrentes')}}</x-slot>
        <x-slot name="content">
            <div id="calendar"></div>
        </x-slot>


        @push('script')
            <script>


                //Abrir modal cadastro
                function openModal(modalID){
                    var modal = document.getElementById(modalID);
                    modal.style.display = "block";
                }

                function openModalEdit(modalID){
                    var modal = document.getElementById(modalID);
                    modal.style.display = "block";
                }

                //Fechar modal Cadastro
                function closeModal(modalID){
                    var modal = document.getElementById(modalID);
                    modal.style.display = "none";
                    @this.descricao = '';
                    @this.value = '';
                    @this.color = '';
                }


                //Fechar modal Edit
                function closeModalEdit(modalID){
                    var modal = document.getElementById(modalID);
                    modal.style.display = "none";
                    @this.recorrente_id = '';
                    @this.descricao = '';
                    @this.value = '';
                    @this.color = '';
                }


                //Fechar modal Registro
                $('#closeModal').click(function(){

                    closeModal('modalCreate');

                });
                $('#closeModalEdit').click(function(){

                    closeModalEdit('modalEdit');

                    });



                // Calendario
                const calenderEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calenderEl, {
                    contentHeight: "auto",
                    initialView: 'dayGridMonth',
                    locale: 'pt-BR',
                    selectable: true,

                    select: function(startStr) {
                        //Pegar dia calendario
                        @this.data = startStr.startStr;

                        openModal('modalCreate');
                        console.log(event);

                    },

                    eventClick: function(event) {
                        @this.descricao = event.event.title;
                        @this.data = event.event.startStr;
                        @this.value = event.event.extendedProps.value;
                        @this.recorrente_id = event.event.id;
                        openModalEdit('modalEdit');
                        console.log(event);
                    }
                });


                //Mascara valor
                $(".value_valor").maskMoney({prefix: "R$ ", affixesStay: true, decimal:",", thousands:".", allowZero: true, allowNegative: false});

                calendar.addEventSource({
                    url:'/api/calendar/recorrentes',
                    extraParams: function() {
                        return {
                            custom_param1: 'value'
                        };
                    }
                });



                calendar.render();

                //Recebendo DispatchEvent Controller
                document.addEventListener('closeModalCreate', function({detail}) {
                    if(detail.close) {
                            closeModal('modalCreate');
                    }
                });


                document.addEventListener('refreshEventCalendar', ({detail}) => {
                    if(detail.refresh){
                        calendar.refetchEvents();
                    }
                });


                document.addEventListener('closeModalEdit', function({detail}) {
                    if(detail.close) {
                            closeModalEdit('modalEdit');
                    }
                });

            </script>
        @endpush

    </x-jet-action-section>
</div>