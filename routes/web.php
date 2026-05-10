<?php

use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\PerbandinganKriteriaController;
use App\Http\Controllers\Admin\SkalaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guest\PilihKriteriaController;
use App\Http\Controllers\Guest\RatingController;
use App\Http\Controllers\Guest\RekomendasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// User Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Admin Authentication
Route::middleware('guest')->group(function () {
    Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/guide', function () { return view('admin.guide'); })->name('admin.guide');

    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->whereNumber('id')->name('kriteria.update');
    Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->whereNumber('id')->name('kriteria.destroy');
    Route::post('/kriteria/update-bobot', [KriteriaController::class, 'updateBobot'])->name('kriteria.update-bobot');

    Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
    Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::put('/alternatif/{id}', [AlternatifController::class, 'update'])->whereNumber('id')->name('alternatif.update');
    Route::delete('/alternatif/{id}', [AlternatifController::class, 'destroy'])->whereNumber('id')->name('alternatif.destroy');

    Route::get('/skala', [SkalaController::class, 'index'])->name('skala.index');
    Route::post('/skala', [SkalaController::class, 'store'])->name('skala.store');
    Route::put('/skala/{skala}', [SkalaController::class, 'update'])->whereNumber('skala')->name('skala.update');
    Route::delete('/skala/{skala}', [SkalaController::class, 'destroy'])->whereNumber('skala')->name('skala.destroy');

    Route::get('/perbandingan-kriteria', [PerbandinganKriteriaController::class, 'index'])->name('perbandingan-kriteria.index');
    Route::post('/perbandingan-kriteria/store', [PerbandinganKriteriaController::class, 'store'])->name('perbandingan-kriteria.store');
    Route::post('/perbandingan-kriteria/proses', [PerbandinganKriteriaController::class, 'proses'])->name('perbandingan-kriteria.proses');

    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
});

/*
|--------------------------------------------------------------------------
| User / Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guest'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [RatingController::class, 'index'])->name('guest.rating.index');
    Route::post('/dashboard', [RatingController::class, 'store'])->name('guest.rating.store');

    // Rekomendasi
    Route::get('/rekomendasi', [RekomendasiController::class, 'index'])->name('guest.rekomendasi');
});
