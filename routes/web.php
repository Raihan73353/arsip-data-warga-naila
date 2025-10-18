<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkteNikahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

use App\Http\Controllers\KtpController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

Route::resource('akte_nikah', AkteNikahController::class)->middleware(\App\Http\Middleware\CheckLogin::class);;



Route::resource('kk', KartuKeluargaController::class)->middleware(\App\Http\Middleware\CheckLogin::class);;
Route::get('/kk/{id}', [KartuKeluargaController::class, 'show'])->name('kk.show')->middleware(\App\Http\Middleware\CheckLogin::class);;

Route::resource('ktp', KtpController::class)->middleware(\App\Http\Middleware\CheckLogin::class);;


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store']);
Route::get('/user/password', [UserController::class, 'editPassword'])->name('user.password.edit');
Route::post('/user/password', [UserController::class, 'updatePassword'])->name('user.password.update');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(\App\Http\Middleware\CheckLogin::class);;
