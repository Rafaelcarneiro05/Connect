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
            'contact.name' => 'required|string',
            'contact.email' => 'required|email',
            'contact.password' => 'required|string|min:6|max:12',
            'contact.phone' => 'required|string|min:8',
            'contact.address' => 'required|string',
            'contact.birth_date' => 'required|date',
            'contact.cpf' => 'required|string',
            'contact.bank_account' => 'required|string',
            'contact.sort_code' => 'required|string',
            'contact.cep' => 'required|string|min:8',
            'contact.endereco' => 'required|string|',
            'contact.bairro' => 'required|string|',
            'contact.complemento' => 'nullable|string|',
            'contact.cidade' => 'required|string|',
            'contact.estado' => 'required|string|',
        ];
    }
}
