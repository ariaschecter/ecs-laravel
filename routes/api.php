<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;
use Laravel\Sanctum\Sanctum;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::post('user/edit/{user:id}', [AuthController::class, 'updateUser']);
});

// Route::controller(MapelController::class)->group(function () {
//     Route::get('/mapel', 'index');
//     Route::get('/mapel/show/{mapel:mapel_id}', 'show');
//     Route::get('/mapel/add', 'create');
//     Route::post('/mapel/add', 'store');
//     Route::get('/mapel/edit/{mapel:mapel_id}', 'edit');
//     Route::post('/mapel/edit/{mapel:mapel_id}', 'update');
//     Route::get('/mapel/delete/{mapel:mapel_id}', 'destroy');
// });

Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'index');
    Route::get('role/{role:role_id}', 'show');
    Route::post('role/add', 'store');
    Route::post('role/edit/{role:role_id}', 'update');
    Route::delete('role/delete/{role:role_id}', 'destroy');
});
