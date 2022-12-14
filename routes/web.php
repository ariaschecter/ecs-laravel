<?php

use App\Http\Controllers\ScoreQuizController;
use App\Http\Controllers\ChoiceQuizController;
use App\Http\Controllers\ListMapelController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\QuestionQuizController;
use App\Http\Controllers\SubMapelController;

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

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'loginpage')->name('login');
    Route::post('/', 'login');
    Route::get('/auth/logout', 'logout');
});

Route::middleware('auth', 'isAdmin')->group(function () {
    Route::controller(MapelController::class)->group(function () {
        Route::get('/mapel', 'index');
        Route::get('/mapel/show/{mapel:mapel_id}', 'show');
        Route::get('/mapel/add', 'create');
        Route::post('/mapel/add', 'store');
        Route::get('/mapel/edit/{mapel:mapel_id}', 'edit');
        Route::post('/mapel/edit/{mapel:mapel_id}', 'update');
        Route::get('/mapel/delete/{mapel:mapel_id}', 'destroy');
    });

    Route::controller(SubMapelController::class)->group(function () {
        Route::get('/sub_mapel', 'index');
        Route::get('/sub_mapel/add', 'create');
        Route::post('/sub_mapel/add', 'store');
        Route::get('/sub_mapel/edit/{sub_mapel:sub_mapel_id}', 'edit');
        Route::post('/sub_mapel/edit/{sub_mapel:sub_mapel_id}', 'update');
        Route::get('/sub_mapel/delete/{sub_mapel:sub_mapel_id}', 'destroy');
    });

    Route::controller(ListMapelController::class)->group(function () {
        Route::get('/list_mapel', 'index');
        Route::get('/list_mapel/add', 'create');
        Route::post('/list_mapel/add', 'store');
        Route::get('/list_mapel/edit/{list_mapel:list_mapel_id}', 'edit');
        Route::post('/list_mapel/edit/{list_mapel:list_mapel_id}', 'update');
        Route::get('/list_mapel/delete/{list_mapel:list_mapel_id}', 'destroy');
    });

    Route::controller(QuestionQuizController::class)->group(function () {
        Route::get('/question', 'index');
        Route::get('/question/add', 'create');
        Route::post('/question/add', 'store');
        Route::get('/question/edit/{question_quiz:question_id}', 'edit');
        Route::post('/question/edit/{question_quiz:question_id}', 'update');
        Route::get('/question/delete/{question_quiz:question_id}', 'destroy');
        Route::get('/quiz', 'quiz');
        Route::post('/quiz', 'result');
    });

    Route::controller(ChoiceQuizController::class)->group(function () {
        Route::get('/choice', 'index');
        Route::get('/choice/add', 'create');
        Route::post('/choice/add', 'store');
        Route::get('/choice/edit/{choice_quiz:choice_id}', 'edit');
        Route::post('/choice/edit/{choice_quiz:choice_id}', 'update');
        Route::get('/choice/delete/{choice_quiz:choice_id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/add', 'create');
        Route::post('/user/add', 'store');
        Route::get('/user/edit/{user:id}', 'edit');
        Route::post('/user/edit/{user:id}', 'update');
        Route::get('/user/delete/{user:id}', 'destroy');
        Route::get('/logout', 'logout');
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

    Route::controller(ScoreQuizController::class)->group(function () {
        Route::get('/score', 'index');
        Route::get('/score/add', 'create');
        Route::post('/score/add', 'store');
        Route::get('/score/edit/{scoreQuiz:score_id}', 'edit');
        Route::post('/score/update/{scoreQuiz:score_id}', 'update');
        Route::get('/score/delete/{scoreQuiz:score_id}', 'destroy');
    });
});
