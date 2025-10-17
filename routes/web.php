<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\KtpController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('kk', KartuKeluargaController::class);
Route::get('/kk/{id}', [KartuKeluargaController::class, 'show'])->name('kk.show');

Route::resource('ktp', KtpController::class);


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
