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
use App\Http\Controllers\PemasukanController;
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
        Route::resource('pengeluaran', PengeluaranController::class)->names('admin.pengeluaran');
        Route::post('pengeluaran/{pengeluaran}/approve', [PengeluaranController::class, 'approve'])->name('admin.pengeluaran.approve');
        Route::post('pengeluaran/{pengeluaran}/reject', [PengeluaranController::class, 'reject'])->name('admin.pengeluaran.reject');
        Route::post('pengeluaran/{pengeluaran}/upload-document/{stage}', [PengeluaranController::class, 'uploadDocument'])->name('admin.pengeluaran.upload-document');
        Route::get('pengeluaran/{pengeluaran}/download-document/{stage}', [PengeluaranController::class, 'downloadDocument'])->name('admin.pengeluaran.download-document');
        Route::get('pengeluaran/export/pdf', [PengeluaranController::class, 'exportPdf'])->name('admin.pengeluaran.export-pdf');
        Route::get('pengeluaran/export/excel', [PengeluaranController::class, 'exportExcel'])->name('admin.pengeluaran.export-excel');

        // Pemasukan routes
        Route::resource('pemasukan', PemasukanController::class)->names('admin.pemasukan');
        Route::post('pemasukan/{pemasukan}/approve', [PemasukanController::class, 'approve'])->name('admin.pemasukan.approve');
        Route::post('pemasukan/{pemasukan}/reject', [PemasukanController::class, 'reject'])->name('admin.pemasukan.reject');
        Route::post('pemasukan/{pemasukan}/upload-document/{stage}', [PemasukanController::class, 'uploadDocument'])->name('admin.pemasukan.upload-document');
        Route::get('pemasukan/{pemasukan}/download-document/{stage}', [PemasukanController::class, 'downloadDocument'])->name('admin.pemasukan.download-document');
        Route::get('pemasukan/export/pdf', [PemasukanController::class, 'exportPdf'])->name('admin.pemasukan.export-pdf');
        Route::get('pemasukan/export/excel', [PemasukanController::class, 'exportExcel'])->name('admin.pemasukan.export-excel');

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

        // User Pemasukan routes
        Route::resource('pemasukan', PemasukanController::class)->names([
            'index' => 'user.pemasukan.index',
            'create' => 'user.pemasukan.create',
            'store' => 'user.pemasukan.store',
            'show' => 'user.pemasukan.show',
            'edit' => 'user.pemasukan.edit',
            'update' => 'user.pemasukan.update',
            'destroy' => 'user.pemasukan.destroy',
        ]);
        Route::post('pemasukan/{pemasukan}/upload-document/{stage}', [PemasukanController::class, 'uploadDocument'])->name('user.pemasukan.upload-document');
        Route::get('pemasukan/{pemasukan}/download-document/{stage}', [PemasukanController::class, 'downloadDocument'])->name('user.pemasukan.download-document');

        // User Pengeluaran routes
        Route::resource('pengeluaran', PengeluaranController::class)->names([
            'index' => 'user.pengeluaran.index',
            'create' => 'user.pengeluaran.create',
            'store' => 'user.pengeluaran.store',
            'show' => 'user.pengeluaran.show',
            'edit' => 'user.pengeluaran.edit',
            'update' => 'user.pengeluaran.update',
            'destroy' => 'user.pengeluaran.destroy',
        ]);
        Route::post('pengeluaran/{pengeluaran}/upload-document/{stage}', [PengeluaranController::class, 'uploadDocument'])->name('user.pengeluaran.upload-document');
        Route::get('pengeluaran/{pengeluaran}/download-document/{stage}', [PengeluaranController::class, 'downloadDocument'])->name('user.pengeluaran.download-document');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

require __DIR__ . '/auth.php';
