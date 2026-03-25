<?php

use App\Http\Controllers\HeaderBelanjaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SumberdanaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::resource('sumberdana', SumberdanaController::class);
    Route::resource('realisasi', RealisasiController::class);
    Route::resource('header-belanja', HeaderBelanjaController::class);
});

require __DIR__ . '/auth.php';
