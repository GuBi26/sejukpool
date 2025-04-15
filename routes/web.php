<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Autentikasi (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Route untuk Admin (Hanya Bisa Diakses Jika Login sebagai Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminMiddleware::class])->group(function () {

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // // Dashboard Admin
    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    // Kelola Petugas
    Route::get('/admin/petugas/index', [UserController::class, 'viewStaff'])->name('admin.petugas.index');
    Route::get('/admin/petugas/add', [UserController::class, 'createStaff'])->name('admin.petugas.add');
    Route::post('/admin/petugas/add', [UserController::class, 'storeStaffView'])->name('admin.petugas.store');
    Route::get('/admin/petugas/{id}/edit', [UserController::class, 'editStaff'])->name('admin.petugas.edit');
    Route::put('/admin/petugas/{id}', [UserController::class, 'updateStaff'])->name('admin.petugas.update');
    Route::delete('/admin/petugas/{id}', [UserController::class, 'destroyStaff'])->name('admin.petugas.destroy');

    // Tambah Petugas via Form Admin (bukan dari halaman khusus)
    Route::post('/admin/add-petugas', [UserController::class, 'addPetugas']);

    Route::get('/admin/transaksi/index', function () {
        return view('admin.transaksi.index');
    })->name('kelola.transaksi');

    Route::get('/admin/voucher/index', function () {
        return view('admin.voucher.index');
    })->name('kelola.voucher');

    // Kelola Pengguna/Pelanggan
    Route::get('/admin/user/index', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/add', [UserController::class, 'create'])->name('admin.user.add');
    Route::post('/admin/user/add', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Tambah Petugas via Form Admin (bukan dari halaman khusus)
    Route::post('/admin/add-user', [UserController::class, 'addUser']);

    // CRUD TIKET
    Route::get('/admin/tiket/index', [TicketController::class, 'index'])->name('admin.tiket.index');
    Route::get('/admin/tiket/add', [TicketController::class, 'create'])->name('admin.tiket.add');
    Route::post('/admin/tiket/add', [TicketController::class, 'store'])->name('admin.tiket.store');
    Route::get('/admin/tiket/{id}/edit', [TicketController::class, 'edit'])->name('admin.tiket.edit');
    Route::put('/admin/tiket/{id}', [TicketController::class, 'update'])->name('admin.tiket.update');
    Route::delete('/admin/tiket/{id}', [TicketController::class, 'destroy'])->name('admin.tiket.destroy');


});

/*
|--------------------------------------------------------------------------
| Route untuk Petugas (Hanya Bisa Diakses Jika Login sebagai Petugas)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', PetugasMiddleware::class])->group(function () {
    Route::get('/petugas/dashboard', function () {
        return view('petugas.dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Halaman Home Setelah Login (Semua User)
|--------------------------------------------------------------------------
*/
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Route untuk User (CRUD oleh Admin)
|--------------------------------------------------------------------------
*/
Route::get('/users', [UserController::class, 'index']); // Lihat semua user
Route::get('/users/{id}', [UserController::class, 'show']); // Detail user
Route::put('/users/{id}', [UserController::class, 'update']); // Update user
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Hapus user

/*
|--------------------------------------------------------------------------
| Route Tiket (User)
|--------------------------------------------------------------------------
*/
Route::get('/ticket', [TicketController::class, 'showTicketForm'])->name('ticket');

/*
|--------------------------------------------------------------------------
| Route History (User)
|--------------------------------------------------------------------------
*/
Route::get('/history', [HistoryController::class, 'historyTicket'])->name('history');
/*
|--------------------------------------------------------------------------
| (Optional) Rute Petugas REST (jika diperlukan)
|--------------------------------------------------------------------------
| Sudah di-comment karena fungsinya sudah ditangani di atas.
*/


// Route::prefix('staff')->group(function () {
//     Route::get('/', [UserController::class, 'indexStaff']);
//     Route::get('/{id}', [UserController::class, 'showStaff']);
//     Route::post('/', [UserController::class, 'storeStaff']);
//     Route::put('/{id}', [UserController::class, 'updateStaff']);
//     Route::delete('/{id}', [UserController::class, 'destroyStaff']);
// });
