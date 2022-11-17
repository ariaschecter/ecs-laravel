<?php

use App\Http\Controllers\API\AccessMapelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmailVerifyController;
use App\Http\Controllers\API\ListMapelController;
use App\Http\Controllers\API\MapelController;
use App\Http\Controllers\API\NewPasswordController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SubMapelController;

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
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/show', 'showUser')->middleware('verified');
        Route::get('/logout', 'logout');
        Route::post('/user/edit/{user:id}', 'updateUser');
    });
    Route::delete('/user/delete/{user:id}', 'destroy');
});

Route::controller(EmailVerifyController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::get('/email/verify/resend-verification', 'send')->name('verification.send');
});

Route::controller(NewPasswordController::class)->group(function () {
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password', 'reset');
});

Route::controller(MapelController::class)->group(function () {
    Route::get('/mapel', 'index');
    Route::post('/mapel/add', 'store');
    Route::get('/mapel/show/{mapel:mapel_id}', 'show');
    Route::post('/mapel/edit/{mapel:mapel_id}', 'update');
    Route::delete('/mapel/delete/{mapel:mapel_id}', 'destroy');
});

Route::controller(SubMapelController::class)->group(function () {
    Route::get('/sub_mapel', 'index');
    Route::post('/sub_mapel/add', 'store');
    Route::get('/sub_mapel/show/{subMapel:sub_mapel_id}', 'show');
    Route::get('/sub_mapel/show_by_mapel/{subMapel:mapel_id}', 'edit');
    Route::post('/sub_mapel/edit/{subMapel:sub_mapel_id}', 'update');
    Route::delete('/sub_mapel/delete/{subMapel:sub_mapel_id}', 'destroy');
});

Route::controller(ListMapelController::class)->group(function () {
    Route::get('/list_mapel', 'index');
    Route::post('/list_mapel/add', 'store');
    Route::get('/list_mapel/show/{listMapel:list_mapel_id}', 'show');
    Route::get('/list_mapel/show_by_sub_mapel/{listMapel:sub_mapel_id}', 'edit');
    Route::post('/list_mapel/edit/{listMapel:list_mapel_id}', 'update');
    Route::delete('/list_mapel/delete/{listMapel:list_mapel_id}', 'destroy');
});

Route::controller(AccessMapelController::class)->group(function () {
    Route::get('/access_mapel', 'index');
    Route::post('/access_mapel/add', 'store');
    Route::get('/access_mapel/show/{accessMapel:access_mapel_id}', 'show');
    Route::get('/access_mapel/show_by_user/{accessMapel:id}', 'edit');
    Route::post('/access_mapel/edit/{accessMapel:access_mapel_id}', 'update');
    Route::delete('/access_mapel/delete/{accessMapel:access_mapel_id}', 'destroy');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role', 'index');
    Route::post('/role/add', 'store');
    Route::get('/role/show/{role:role_id}', 'show');
    Route::post('/role/edit/{role:role_id}', 'update');
    Route::delete('/role/delete/{role:role_id}', 'destroy');
});

Route::controller(PaymentController::class)->group(function () {
    Route::get('/payment', 'index');
    Route::post('/payment/add', 'store');
    Route::get('/payment/show/{payment:payment_id}', 'show');
    Route::get('/payment/show_by_user/{payment:id}', 'show');
    Route::post('/payment/edit/{payment:payment_id}', 'update');
    Route::delete('/payment/delete/{payment:payment_id}', 'destroy');
});

Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/payment_method', 'index');
    Route::post('/payment_method/add', 'store');
    Route::get('/payment_method/show/{paymentMethod:payment_method_id}', 'show');
    Route::post('/payment_method/edit/{paymentMethod:payment_method_id}', 'update');
    Route::delete('/payment_method/delete/{paymentMethod:payment_method_id}', 'destroy');
});

Route::controller(ChoiceQuizController::class)->group(function () {
    Route::get('/choice', 'index');
    Route::get('/choice/add', 'create');
    Route::post('/choice/add', 'store');
    Route::post('/choice/edit/{choice_quiz:choice_id}', 'update');
    Route::get('/choice/delete/{choice_quiz:choice_id}', 'destroy');
});

Route::controller(QuestionQuizController::class)->group(function () {
    Route::get('/question', 'index');
    Route::get('/question/add', 'create');
    Route::post('/question/add', 'store');
    Route::post('/question/edit/{question_quiz:question_id}', 'update');
    Route::get('/question/delete/{question_quiz:question_id}', 'destroy');
    Route::get('/quiz', 'quiz');
    Route::post('/quiz', 'result');
});