<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DataSuratController;
use App\Http\Controllers\SuratController;


Route::get('/', function () {
    return redirect(route('home'));
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('surat', SuratController::class)->middleware('auth');
Route::get('/data/semua', [DataSuratController::class, 'semua'])->name('data.semua')->middleware('auth');
Route::get('/data/masuk', [DataSuratController::class, 'masuk'])->name('data.masuk')->middleware('auth');


Route::get('/download/masuk/{file}', DownloadController::class)->name('download')->middleware('auth');
