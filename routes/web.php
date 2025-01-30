<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranRawatJalanController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
   // Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pasien/search', [PasienController::class, 'search'])->name('pasien.search');
    Route::resource('/pasien', PasienController::class);
    Route::get('/pendaftaran', [PendaftaranRawatJalanController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranRawatJalanController::class, 'store'])->name('pendaftaran.store');

});

