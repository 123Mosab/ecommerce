<?php

use App\Http\Controllers\Dashboard\LoginController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:admin')->group(function (){ 

         Route::get('users', function (){

         return 'in admin';
         
       });
       
  
      });

 Route::middleware('guest:admin')->group(function (){ 
         
         Route::get('login', [LoginController::class, 'login'])->name('admin.login');
 
      });
