<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\Api\ApiSuratController;



Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect(route('home'));
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/surat-masuk', [SuratController::class, 'masuk'])->name('surat-masuk');
    Route::get('/surat-keluar', [SuratController::class, 'keluar'])->name('surat-keluar');
    Route::get('/surat/create/{jenis}', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat/create/{jenis}', [SuratController::class, 'store'])->name('surat.store');
    

    Route::get('/surat/show/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/disposisi/{id}', [SuratController::class, 'disposisi'])->name('surat.disposisi');
    Route::get('/surat/terima/{id}', [SuratController::class, 'terima'])->name('surat.terima');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth.api')->group(function () {
    Route::get('/api/surat-masuk', [ApiSuratController::class, 'index']);
});
