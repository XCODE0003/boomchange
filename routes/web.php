<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index']);
Route::post('/ajax/process_exchange_from', [PageController::class, 'processExchangeFrom']);
Route::post('/ajax/process_amount_to', [PageController::class, 'processAmountTo']);
Route::post('/ajax/process_exchange_to', [PageController::class, 'processExchangeTo']);
Route::post('/ajax/process_exchange_form', [PageController::class, 'processExchangeForm']);
Route::get('/order/{cscv}', [PageController::class, 'order']);

Route::get('/exchange', [PageController::class, 'exchange']);
Route::get('/contacts', [PageController::class, 'contacts']);
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy']);
Route::get('/terms-of-use', [PageController::class, 'termsOfUse']);





