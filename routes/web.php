<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ExportPDF;
use App\Http\Controllers\FinancialPDFController;
use App\Http\Livewire\Financial\FinancialBrief;
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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function ()
{
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// ********************************************************************************************************
// ROTAS DO MODULO financial----> TODAS ACESSADAS PELO ADMIN
// ********************************************************************************************************
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.admin'
])->group(function () {
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
    //DOWNLOAD PDF//DOWNLOAD PDF//DOWNLOAD PDF//DOWNLOAD PDF//DOWNLOAD PDF
    Route::get('/financial/brief/financial_pdf',[FinancialPDFController::class, 'exportPDF'])
    ->name('financial_pdf');



    //EMPRESAS//EMPRESAS//EMPRESAS
    Route::get('/financial/company', function () {
        return view('livewire/financial/company-list');
    })->name('list-empresa');

    //CALENDARIO//CALENDARIO//CALENDARIO
    Route::get('/financial/calendar', function () {
        return view('livewire/financial/calendar-list');
    })->name('list-recorrentes');

});



// ********************************************************************************************************
//              ROTAS DO MODLO PEOPLE
// ********************************************************************************************************
//rotas modo people para admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.admin'
])->group(function ()
{
    Route::get('/people/employee-module', function (){
        return view('livewire/people/employee-module');
    })->name('employee-module');

    Route::get('/people/effort-admin-module', function () {
        return view('livewire/people/effort-admin-module');
    })->name('effort-admin-module');

    //rota pdf
    Route::get('/people/effort_pdf/{id_user}/{from}/{to}',[App\Http\Controllers\EffortPdfController::class, 'exportPDF'])
    ->name('effort_pdf');

});

//rotas do modo people para projects_manager
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.projectsManager'
])->group(function ()
{
    Route::get('/projects/projects-module', function () {
        return view('livewire/projects/projects-module');
    })->name('projects-module');

    Route::get('/people/effort-module', function () {
        return view('livewire/people/effort-module');
    })->name('effort-module');
});

//rotas modo people para users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'is.user'
])->group(function ()
{
    Route::get('/people/effort-module', function () {
        return view('livewire/people/effort-module');
    })->name('effort-module');
});



//HENRIQUE
// ********************************************************************************************************
//              ROTAS DO MODULO PROJECTS
// ********************************************************************************************************
//rotas modo PROJECTS para admin






//rotas modo PROJECTS para users



