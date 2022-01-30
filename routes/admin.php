<?php

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect','localizationRedirect','localeViewPath'])->group(function(){
      Route::prefix('admin')->middleware('auth:admin')->group(function (){ 

               Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

               Route::prefix('settings')->group(function(){

                     Route::get('shipping-methods/{type}',[SettingsController::class,'editShippingMethods'])->name('edit.shipping.method');
                     Route::put('shipping-methods/{id}',[SettingsController::class,'updateShippingMethods'])->name('update.shipping.method');

               });
      
            });

      Route::prefix('admin')->middleware('guest:admin')->group(function (){ 
               
               Route::get('login', [LoginController::class, 'login'])->name('login');
               Route::post('login', [LoginController::class, 'PostLogin'])->name('post.login');

      
            });
   });