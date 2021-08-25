<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractOrderController;
use App\Http\Controllers\OrdersController;

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

// Contracts
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

Route::post('/dashboard/contract/{contract_id}/approve/{order_id}', [ContractOrderController::class, 'approve'])
->middleware(['auth'])
->name('approveContract');

// Orders
Route::get('/dashboard/contract/{contract_id}/orders', [ContractOrderController::class, 'index'])
->middleware(['auth'])
->name('contractOrders');

Route::get('/dashboard/contract/{contract_id}/order/{order_id}', [ContractOrderController::class, 'show'])
->middleware(['auth'])
->name('orderDetails');

Route::post('/dashboard/contract/{contract_id}/order/update_approval/{order_id}', [ContractOrderController::class, 'updateOrderApprovalDate'])
->middleware(['auth'])
->name('updateOrderApprovalDate');

Route::post('/dashboard/contract/{contract_id}/order/update_sent_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderSentActualDate'])
->middleware(['auth'])
->name('updateOrderSentActualDate');

Route::post('/dashboard/contract/{contract_id}/order/update_purchases_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderPurchasesActualDate'])
->middleware(['auth'])
->name('updateOrderPurchasesActualDate');

Route::post('/dashboard/contract/{contract_id}/order/update_production_started_date/{order_id}', [ContractOrderController::class, 'updateOrderProductionStartedDate'])
->middleware(['auth'])
->name('updateOrderProductionStartedDate');


Route::post('/dashboard/contract/{contract_id}/order/update_production_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderProductionActualDate'])
->middleware(['auth'])
->name('updateOrderProductionActualDate');


Route::post('/dashboard/contract/{contract_id}/order/update_distortion_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderDistortionActualDate'])
->middleware(['auth'])
->name('updateOrderDistortionActualDate');


Route::post('/dashboard/contract/{contract_id}/order/update_installation_started_date/{order_id}', [ContractOrderController::class, 'updateOrderInstallStartedDate'])
->middleware(['auth'])
->name('updateOrderInstallStartedDate');


Route::post('/dashboard/contract/{contract_id}/order/update_install_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderInstallActualDate'])
->middleware(['auth'])
->name('updateOrderInstallActualDate');

Route::post('/dashboard/contract/{contract_id}/order/update_note_actual_date/{order_id}', [ContractOrderController::class, 'updateOrderNoteActualDate'])
->middleware(['auth'])
->name('updateOrderNoteActualDate');

// Orders View and fillters
Route::get('/dashboard/contracts/orders', [OrdersController::class, 'index'])
->middleware(['auth'])
->name('allOrders');

//
Route::post('/dashboard/contract/order/{order_id}', [ContractOrderController::class, 'destroy'])
->middleware(['auth'])
->name('deleteOrder');


Route::post('/dashboard/contract/{contract_id}/orders', [ContractOrderController::class, 'store'])
->middleware(['auth'])
->name('saveOrder');

require __DIR__.'/auth.php';
