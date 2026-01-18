<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| USER (PENCARI KOS)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KosController as UserKosController;
use App\Http\Controllers\User\BookingController as UserBookingController;

/**
 * =========================
 * HALAMAN 0 (LANDING PAGE)
 * =========================
 * URL: /
 */
Route::get('/', [UserDashboardController::class, 'index'])
    ->name('user.dashboard');

/**
 * =========================
 * DETAIL KOS
 * =========================
 */
Route::get('/kos/{kos}', [UserKosController::class, 'show'])
    ->name('kos.detail');

/**
 * =========================
 * BOOKING (WAJIB LOGIN)
 * =========================
 */
Route::middleware('auth')->group(function () {

    // Form booking
    Route::get('/booking/{kos}', [UserBookingController::class, 'create'])
        ->name('booking.create');

    // Simpan booking
    Route::post('/booking/{kos}', [UserBookingController::class, 'store'])
        ->name('booking.store');

    /**
     * =========================
     * DASHBOARD USER (AKUN)
     * =========================
     * URL: /dashboard
     */
    Route::get('/dashboard', [UserDashboardController::class, 'userDashboard'])
        ->name('dashboard');

    // Update profil user
    Route::post('/user/profile', [UserDashboardController::class, 'updateProfile'])
        ->name('user.profile.update');
});

/*
|--------------------------------------------------------------------------
| AUTH USER (BREEZE – BIARKAN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN (PEMILIK KOS)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KosController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\KosImageController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Login admin
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Area admin (protected)
    Route::middleware('admin')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD kos
        Route::resource('kos', KosController::class);

        // Pembayaran / booking
        Route::get('pembayaran', [PembayaranController::class, 'index'])
            ->name('pembayaran.index');

        Route::post('pembayaran/{booking}/approve', [PembayaranController::class, 'approve'])
            ->name('pembayaran.approve');

        Route::post('pembayaran/{booking}/reject', [PembayaranController::class, 'reject'])
            ->name('pembayaran.reject');

        // Hapus gambar kos
        Route::delete('kos-image/{image}', [KosImageController::class, 'destroy'])
            ->name('kos.image.destroy');
    });
});
