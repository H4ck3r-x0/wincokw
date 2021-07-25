<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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

require __DIR__.'/auth.php';
