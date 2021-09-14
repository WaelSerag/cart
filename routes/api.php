<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;

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
// api/web

// Carts
Route::post('carts/store'            ,[CartController::class, 'store'])->name('carts.store');
Route::get('cart/{mobile_identifier}',[CartController::class, 'index'])->name('carts.index');
