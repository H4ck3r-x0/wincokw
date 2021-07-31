<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Clients 
Route::get('/dashboard/clients/create', [ClientController::class, 'create'])
->middleware(['auth'])
->name('createClient');

Route::post('/dashboard/clients', [ClientController::class, 'store'])
->middleware(['auth'])
->name('saveClient');

Route::get('/dashboard/clients', [ClientController::class, 'index'])
->middleware(['auth'])
->name('allClients');

Route::get('/dashboard/contracts/create', [ContractController::class, 'create'])
->middleware(['auth'])
->name('createContract');

Route::post('/dashboard/contracts', [ContractController::class, 'store'])
->middleware(['auth'])
->name('saveContract');

Route::get('/dashboard/contracts', [ContractController::class, 'index'])
->middleware(['auth'])
->name('allContracts');

Route::post('/dashboard/contracts/{contract}', [ContractController::class, 'destroy'])
->middleware(['auth'])
->name('deleteContract');

require __DIR__.'/auth.php';
