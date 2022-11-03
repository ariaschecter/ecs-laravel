<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MapelController;
use App\Http\Controllers\API\RoleController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', 'logout');
        Route::get('user/show', 'showUser');
        Route::post('user/edit/{user:id}', 'updateUser');
    });
});

Route::controller(MapelController::class)->group(function () {
    Route::get('mapel', 'index');
    Route::get('mapel/show/{mapel:mapel_id}', 'show');
    Route::post('mapel/add', 'store');
    Route::post('mapel/edit/{mapel:mapel_id}', 'update');
    Route::delete('mapel/delete/{mapel:mapel_id}', 'destroy');
});

Route::controller(ListMapelController::class)->group(function () {
    Route::get('/list_mapel', 'index');
    Route::post('/list_mapel/add', 'store');
    Route::post('/list_mapel/show/(listMapel:list_mapel_id}', 'show');
    Route::post('/list_mapel/edit/{listMapel:list_mapel_id}', 'update');
    Route::get('/list_mapel/delete/{listMapel:list_mapel_id}', 'destroy');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'index');
    Route::get('role/{role:role_id}', 'show');
    Route::post('role/add', 'store');
    Route::post('role/edit/{role:role_id}', 'update');
    Route::delete('role/delete/{role:role_id}', 'destroy');
});
