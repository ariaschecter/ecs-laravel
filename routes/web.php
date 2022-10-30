<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaymentMethodController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::get('/user/add', 'create');
    Route::post('/user/add', 'store');
    Route::get('/user/edit/{user:user_id}', 'edit');
    Route::post('/user/edit/{user:user_id}', 'update');
    Route::get('/user/delete/{user:user_id}', 'destroy');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role', 'index');
    Route::get('/role/add', 'create');
    Route::post('/role/add', 'store');
    Route::get('/role/edit/{role:role_id}', 'edit');
    Route::post('/role/edit/{role:role_id}', 'update');
    Route::get('/role/delete/{role:role_id}', 'destroy');
});

Route::controller(PaymentController::class)->group(function () {
    Route::get('/payment', 'index');
    Route::get('/payment/add', 'create');
    Route::post('/payment/add', 'store');
    Route::get('/payment/edit/{payment:payment_id}', 'edit');
    Route::post('/payment/edit/{payment:payment_id}', 'update');
    Route::get('/payment/delete/{payment:payment_id}', 'destroy');
});

Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/payment_method', 'index');
    Route::get('/payment_method/add', 'create');
    Route::post('/payment_method/add', 'store');
    Route::get('/payment_method/edit/{payment_method:payment_method_id}', 'edit');
    Route::post('/payment_method/edit/{payment_method:payment_method_id}', 'update');
    Route::get('/payment_method/delete/{payment_method:payment_method_id}', 'destroy');
});


