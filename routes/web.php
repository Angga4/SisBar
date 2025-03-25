<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated; // Import Middleware

//landing page
Route::get('/', function () {
    return view('landing/landing');
});

Route::get('/detail-barang', [BarangController::class, 'indexLanding'])->name('detail_barang');

//login 
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//dashboard
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('guru', GuruController::class);
});

Route::middleware(['auth', RoleMiddleware::class . ':guru'])->group(function () {
    Route::get('/dashboard/guru', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');
    Route::get('/guru/barang', [BarangController::class, 'indexGuru'])->name('guru.barang');

    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('guru.peminjaman.index');
        Route::get('/create', [PeminjamanController::class, 'create'])->name('guru.peminjaman.create');
        Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])->name('guru.peminjaman.edit');  
        Route::post('/store', [PeminjamanController::class, 'store'])->name(name: 'guru.peminjaman.store');
        Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('guru.peminjaman.destroy');
    });

    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PengembalianController::class, 'index'])->name('guru.pengembalian.index');
        Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('guru.pengembalian.update');
    });
});

Route::resource('barang', BarangController::class)->middleware('auth');

Route::resource('/admin/barang', BarangController::class)->names([
    'index' => 'admin.barang.index',
    'create' => 'admin.barang.create',
    'store' => 'admin.barang.store',
    'edit' => 'admin.barang.edit',
    'update' => 'admin.barang.update',
    'destroy' => 'admin.barang.destroy',
]);

Route::get('/manual-logout', function () {
    return view('manual-logout');
})->name('manual-logout');
Route::post('/manual-logout', [AuthController::class, 'manualLogout'])->name('manual.logout');