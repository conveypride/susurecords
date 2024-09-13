<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Generalcontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

 
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('/');
Route::get('/chart-data', [App\Http\Controllers\HomeController::class, 'getChartData'])->middleware('auth')->name('/chart-data');
Route::get('/customer/booklet-page', [CustomerController::class, 'fetchBookletPage'])->middleware('auth');
Route::get('/customer/booklet-transactions', [CustomerController::class, 'fetchTransactions'])->middleware('auth');
Route::post('/customer/create-booklet-page', [CustomerController::class, 'createBookletPage'])->name('customer.createBookletPage');
Route::post('/customer/save-transaction', [CustomerController::class, 'saveTransaction'])->name('customer.saveTransaction');


Route::controller(Generalcontroller::class)->middleware('auth')->group(function () {
    Route::get('registerCustomer', 'registerCustomer')->name('registerCustomer');
    Route::post('registerCustomerpost', 'registerCustomerpost')->name('registerCustomerpost');
    Route::get('customerDeposit', 'customerDeposit')->name('customerDeposit');
     Route::get('expenses', 'expenses')->name('expenses');
     Route::post('expensespost', 'expensespost')->name('expensespost');
    Route::post('customerDepositpost', 'customerDepositpost')->name('customerDepositpost');
    Route::get('customerDepositpost', 'customerDepositpost');
    Route::post('customerTransactionpost', 'customerTransactionpost')->name('customerTransactionpost');
    Route::get('customerTransactionpostget/{id}', 'customerTransactionpostget')->name('customerTransactionpostget');
    Route::post('withdrawpage', 'withdrawpage')->name('withdrawpage');
     Route::post('withdrawall', 'withdrawall')->name('withdrawall');
      Route::post('increasePage', 'increasePage')->name('increasePage');
       Route::post('edittransactions', 'edittransactions')->name('edittransactions');
        Route::post('edituser', 'edituser')->name('edituser');
     Route::get('compare-total-deposit', 'compareTotalDepositPerYear')->name('compare-total-deposit');
    Route::post('addBulkDeposit', 'addBulkDeposit')->name('addBulkDeposit');
    Route::get('/load-transactions',  'getTransactions')->name('loadtransactions');

    // Route::get('em/dashboard', 'emDashboard')->name('em/dashboard');
});


