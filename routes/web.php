<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;

// Route untuk user mendaftar dan login
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);


// Hanya admin yang bisa menambahkan petugas dan mengakses dashboard admin
    Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::post('/admin/add-petugas', [UserController::class, 'addPetugas']);
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

// Hanya petugas yang bisa mengakses dashboard petugas
    Route::middleware(['auth', PetugasMiddleware::class])->group(function () {
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    });
});

// Halaman home hanya bisa diakses oleh user yang sudah login
    Route::get('/home', function () {
    return view('home');
})->middleware('auth');
