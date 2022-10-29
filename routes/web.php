<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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


