<?php

namespace Tests\Feature\Contacts;

use App\Models\User;
use App\Models\Contact;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Livewire\ApiTokenManager;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function canCreateContact()
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $contactFake =  Contact::factory()->make();
    }

}