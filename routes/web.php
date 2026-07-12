<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\AdminBajuController;
use App\Http\Controllers\Auth\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== HALAMAN PENYEWA (Publik) =====
Route::get('/', [PenyewaController::class, 'index'])->name('penyewa.index');

// ===== ADMIN AUTH =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [AdminBajuController::class, 'index'])->name('dashboard');
        Route::post('/baju', [AdminBajuController::class, 'store'])->name('baju.store');
        Route::get('/baju/{baju}/edit', [AdminBajuController::class, 'edit'])->name('baju.edit');
        Route::put('/baju/{baju}', [AdminBajuController::class, 'update'])->name('baju.update');
        Route::delete('/baju/{baju}', [AdminBajuController::class, 'destroy'])->name('baju.destroy');
    });
});
