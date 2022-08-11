<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/admin/users', AuthController::class);


// ********************************************************************************************************
// ROTAS DO MODULO financial
// ********************************************************************************************************
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/contacts', function () {
        return view('contacts.index');
    })->name('contacts.index');
    Route::get('/contacts/edit', function () {
        return view('contacts/edit');
    })->name('contacts-list');
    Route::get('/contacts/new', function () {
        return view('contacts/new');
    })->name('contacts-new');
    Route::get('/financial/flow', function () {
        return view('livewire/financial/flow');
    })->name('financial-flow');
    Route::get('/financial/brief', function () {
        return view('livewire/financial/brief');
    })->name('financial-brief');
    Route::get('/working-day/register-day', function () {
        return view('livewire/working-day/register-working-day');
    })->name('register-day');

    //EMPRESAS//EMPRESAS//EMPRESAS
    Route::get('/financial/empresas', function () {
        return view('livewire/empresas/list-empresas');
    })->name('list-empresa');

    //RECORRENTES//RECORRENTES//RECORRENTES
    Route::get('/financial/recorrentes', function () {
        return view('livewire/recorrentes/list-recorrentes');
    })->name('list-recorrentes');


});



// ********************************************************************************************************
//              ROTAS DO MODLO PEOPLE
// ********************************************************************************************************
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.admin'
])->group(function ()
{
    //ROTA QUE ABRE A VIEW MODULE, QUE POR SUA VEZ CHAMA O COMPONENTE LIVEWIRE
    Route::get('/people/employee-module', function (){
        return view('livewire/people/employee-module');
    })->name('employee-module');

    Route::get('/people/projects-module', function () {
        return view('livewire/people/projects-module');
    })->name('projects-module');

    Route::get('/people/effort-admin-module', function () {
        return view('livewire/people/effort-admin-module');
    })->name('effort-admin-module');

});




//proteger essa rota!!
Route::get('/people/effort-module', function () {
    return view('livewire/people/effort-module');
})->name('effort-module');





