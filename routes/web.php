<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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



Auth::routes();

Route::get('qrcodes/{qrcode}', [QrcodeController::class, 'show'])->name('qrcodes.show');
Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('qrcodes', App\Http\Controllers\QrcodeController::class)->except('show');


    Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('check-admin');


    Route::resource('transactions', App\Http\Controllers\TransactionController::class)->except('show');


    Route::resource('users', App\Http\Controllers\UserController::class)->except('index');
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('check-moderator');
    Route::get('accounts/my-account', [AccountController::class, 'myAccount'])->name('accounts.my-account');
    Route::post('accounts/apply-payout/{account}', [AccountController::class, 'applyPayout'])->name('accounts.applyPayout');
    Route::post('accounts/mark-as-paid/{account}', [AccountController::class, 'markAsPaid'])->name('accounts.markAsPaid');
    Route::resource('accounts', App\Http\Controllers\AccountController::class);

    Route::resource('accountHistories', App\Http\Controllers\AccountHistoryController::class);
});

// Laravel 8
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);
Route::get('/payment/redirect-to-callback', [App\Http\Controllers\PaymentController::class, 'redirectToCallBack'])->name('redirectToCallBack');


