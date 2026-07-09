<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeaderBelanjaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\SumberdanaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard redirect route
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect('/');
    })->name('dashboard');

    // Admin routes - using middleware with parameter
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Sumber Dana routes
        Route::resource('sumberdana', SumberdanaController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
        Route::post('pengeluaran/{pengeluaran}/approve', [PengeluaranController::class, 'approve'])->name('pengeluaran.approve');
        Route::post('pengeluaran/{pengeluaran}/reject', [PengeluaranController::class, 'reject'])->name('pengeluaran.reject');

        // Import routes
        Route::get('sumberdana/import/form', [SumberdanaController::class, 'showImportForm'])->name('sumberdana.import.form');
        Route::post('sumberdana/import', [SumberdanaController::class, 'import'])->name('sumberdana.import');
        Route::get('sumberdana/template', [SumberdanaController::class, 'downloadTemplate'])->name('sumberdana.template');

        // Admin routes
        Route::delete('sumberdana/truncate/all', [SumberdanaController::class, 'truncate'])->name('sumberdana.truncate');

        Route::resource('realisasi', RealisasiController::class);
        Route::resource('header-belanja', HeaderBelanjaController::class);

        // Setting routes
        Route::get('setting', [SettingController::class, 'index'])->name('admin.setting');
        Route::post('setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::post('setting/update-batch', [SettingController::class, 'updateBatch'])->name('admin.setting.update.batch');
        Route::post('setting/reset', [SettingController::class, 'reset'])->name('admin.setting.reset');
        Route::post('setting/apply-all', [SettingController::class, 'applyToAll'])->name('admin.setting.apply.all');
    });

    // User routes - using middleware with parameter
    Route::middleware(['role:user'])->prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

require __DIR__ . '/auth.php';
