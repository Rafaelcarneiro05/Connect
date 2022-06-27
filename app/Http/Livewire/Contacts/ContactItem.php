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
            'contact.name' => 'nullable|string',
            'contact.email' => 'nullable|email',
            'contact.password' => 'nullable|string|min:6',
            'contact.phone' => 'nullable|string|min:8',
            'contact.birth_date' => 'nullable|date',
            'contact.cpf' => 'nullable|string',
            'contact.bank_account' => 'nullable|string',
            'contact.sort_code' => 'nullable|string',
            'contact.cep' => 'nullable|string|min:8',
            'contact.endereco' => 'nullable|string|',
            'contact.bairro' => 'nullable|string|',
            'contact.complemento' => 'nullable|string|',
            'contact.cidade' => 'nullable|string|',
            'contact.estado' => 'nullable|string|',
        ];
    }
}
