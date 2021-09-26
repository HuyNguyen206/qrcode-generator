<?php

use App\Http\Controllers\QrcodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('client')->group(function(){
    Route::resource('qrcodes', QrcodeController::class);
//    Route::get('qrcodes', [QrcodeController::class, 'index']);
//    Route::get('qrcodes/{qrcode}', [QrcodeController::class, 'show']);
//    Route::post('qrcodes', [QrcodeController::class, 'store']);
});
