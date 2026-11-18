<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| HALAMAN PORTFOLIO (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/cv', [CvController::class, 'index'])->name('cv');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/kontak/pesan', [MessageController::class, 'store'])->name('messages.store');
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');

/*
|--------------------------------------------------------------------------
| AUTENTIKASI ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD & CMS ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pesan masuk
    Route::prefix('admin')->group(function () {
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Persetujuan testimoni pengunjung (didefinisikan sebelum CRUD generik)
        Route::patch('/testimonials/{testimonial}/approval', [TestimonialController::class, 'toggleApproval'])
            ->name('testimonials.approval');

        // Informasi profil / konten website
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // CRUD semua konten portofolio
        Route::get('/{resource}', [CrudController::class, 'index'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.index');
        Route::get('/{resource}/create', [CrudController::class, 'create'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.create');
        Route::post('/{resource}', [CrudController::class, 'store'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.store');
        Route::get('/{resource}/{item}/edit', [CrudController::class, 'edit'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.edit');
        Route::put('/{resource}/{item}', [CrudController::class, 'update'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.update');
        Route::delete('/{resource}/{item}', [CrudController::class, 'destroy'])
            ->whereIn('resource', array_keys(config('portfolio.crud')))
            ->name('admin.destroy');
    });
});
