<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;

<<<<<<< HEAD
// Route untuk user mendaftar dan login
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
=======
Route::get('/', function () {
    return view('welcome');
});

// Route untuk user mendaftar dan login
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
>>>>>>> d4929cc (Update Controller baru)
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


// Rute untuk User (Pelanggan)
Route::get('/users', [UserController::class, 'index']); // Admin melihat daftar user
Route::get('/users/{id}', [UserController::class, 'show']); // Admin melihat detail user
Route::put('/users/{id}', [UserController::class, 'update']); // Admin mengupdate user
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Admin menghapus user

// Rute untuk petugas (Admin/Petugas)
    Route::prefix('staff')->group(function () {
    Route::get('/', [UserController::class, 'indexStaff']);  // Ambil semua petugas
    Route::get('/{id}', [UserController::class, 'showStaff']); // Detail petugas
    Route::post('/', [UserController::class, 'storeStaff']);  // Buat petugas baru
    Route::put('/{id}', [UserController::class, 'updateStaff']); // Update petugas
    Route::delete('/{id}', [UserController::class, 'destroyStaff']); // Hapus petugas
});
