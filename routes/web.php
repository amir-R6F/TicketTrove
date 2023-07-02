<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\myAuth\AuthController;
use \App\Http\Controllers\HomeController;
use App\Http\Controllers\API\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [RegisterController::class, 'logout'])->name('a-logout');


Route::get('/user', function (){
    return "qqq";
})->middleware("userCheck:bill");



