<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\myAuth\AuthController;
use App\Http\Controllers\API\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('register', 'register_page')->name('a-register');
    Route::get('login', 'login_page')->name('a-login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/reserve', [MovieController::class, 'create'])->name('reserve');
    Route::get('/report', [MovieController::class, 'report'])->name('report');
});



