<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\ContactItem;

class ContactList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshList' => '$refresh'];

    public function getListProperty()
    {
        return User::orderBy('id', 'desc')->paginate();
    }

    public function render()
    {
        return view('contacts.contact-list');
    }
}
