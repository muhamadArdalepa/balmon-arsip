<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DataSuratController;
use App\Http\Controllers\SuratMasukController;


Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('surat-masuk', SuratMasukController::class);
Route::get('/data/surat-masuk', [DataSuratController::class, 'masuk'])->name('data.surat-masuk');


Route::get('/download/masuk/{file}', [DownloadController::class, 'masuk'])->name('download.masuk');
