<div>
    @if ($this->list->isNotEmpty())
    <x-jet-section-border/>

    <div>
        <x-jet-action-section>
            <x-slot name="title">{{__('All Employees') }}</x-slot>

            <x-slot name="description">{{__('Edit and details.') }}</x-slot>
            <x-slot name="content">

                    <div class="overflow-x-auto">


                        <table class="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                        @foreach ($this->list as $item)


                                <tbody align="center">
                                    <tr>
                                        <td>{{$item->name }}</td>
                                        <td>{{$item->email }}</td>
                                        <td>{{$item->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            @livewire('contacts.contact-item', ['contact'=>$item], key($item->id))

                        @endforeach
                        {{ $this->list->links() }}
                    </div>
            </x-slot>
        </x-jet-action-section>
    </div>
    @endif
</div>

