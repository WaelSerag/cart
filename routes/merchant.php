<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Merchant\Auth\AuthController;
use App\Http\Controllers\Merchant\ProductController;



/*
|--------------------------------------------------------------------------
| API Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// api/merchant

    ########################## Befor Login (Authuntication) ###############################
    //login
    Route::post('login',[AuthController::class, 'login'])->name('auth.login');
    //register
    Route::post('register',[AuthController::class, 'register'])->name('auth.register');


############################# After Login ###############################
Route::group(['middleware' => ['jwt.verify','merchant']], function (){
    // Products
    Route::post('products/store',[ProductController::class, 'store'])->name('products.store');
    Route::get('products'       ,[ProductController::class, 'index'])->name('products.index');

});
