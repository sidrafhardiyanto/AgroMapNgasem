<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PPLController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\TanamanController;
use App\Http\Controllers\HamaPenyakitController;
use App\Http\Controllers\RekomendasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('lahans.index');
});

// Route untuk PPL
Route::resource('ppls', PPLController::class);

// Route untuk Lahan
Route::resource('lahans', LahanController::class);

// Route untuk Tanaman
Route::resource('tanamans', TanamanController::class);

// Route untuk Hama & Penyakit
Route::resource('hamas', HamaPenyakitController::class);

// Route untuk Rekomendasi
Route::resource('rekomendasis', RekomendasiController::class);

// Route untuk filter data
Route::get('/lahans/filter', [LahanController::class, 'filter'])->name('lahans.filter');
Route::get('/tanamans/filter', [TanamanController::class, 'filter'])->name('tanamans.filter');
Route::get('/hamas/filter', [HamaPenyakitController::class, 'filter'])->name('hamas.filter');

// Route untuk menangani upload gambar
Route::post('/upload/hama', [HamaPenyakitController::class, 'uploadImage'])->name('hama.upload-image');

// Route untuk mendapatkan data terkait
Route::get('/lahans/{lahan}/tanamans', [LahanController::class, 'getTanamans'])->name('lahans.tanamans');
Route::get('/tanamans/{tanaman}/hamas', [TanamanController::class, 'getHamas'])->name('tanamans.hamas');

// Route untuk dashboard (jika diperlukan nanti)
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
