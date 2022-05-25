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
});
