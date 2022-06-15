<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;
use App\Models\Contact;
use App\Models\User;

class ContactItem extends Component
{
    public User $contact;

    public bool $updating;

    public bool $destroying;

    public function edit(User $contact)
    {
        $this->clearValidation();

        $this->updating = true;

        $this->contact = $contact;


    }

    public function update()
    {
        $this->validate();

        $this->contact->save();

        $this->updating = false;

        $this->emit(event: 'refreshList');


    }

    public function confirmDeletion(User $contact)
    {
        $this->destroying = true;

        $this->contact = $contact;

    }

    public function destroy()
    {
        $this->contact->delete();

        $this->destroying = false;

        $this->emit(event:'refreshList');
    }


    public function render()
    {

        return view(view: 'contacts.contact-item');
    }

    public function rules()
    {
        return [
            'contact.name' => 'string',
            'contact.email' => 'email',
            'contact.password' => 'string|min:6|max:12',
            'contact.phone' => 'string|min:8',

            'contact.birth_date' => 'date',
            'contact.cpf' => 'string',
            'contact.bank_account' => 'string',
            'contact.sort_code' => 'string',
            'contact.cep' => 'string|min:8',
            'contact.endereco' => 'string|',
            'contact.bairro' => 'string|',
            'contact.complemento' => 'nullable|string|',
            'contact.cidade' => 'string|',
            'contact.estado' => 'string|',
        ];
    }
}
