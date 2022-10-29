<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
