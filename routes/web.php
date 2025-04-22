<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetugasMiddleware;

/*
|--------------------------------------------------------------------------
| Halaman Awal & Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Autentikasi (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Route untuk User yang Sudah Login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', function () { return view('home'); })->name('home.auth');
    
    // Pemesanan Tiket
    Route::get('/ticket', [TicketController::class, 'showTicketForm'])->name('ticket');
    Route::post('/tickets/order', [TicketController::class, 'storeOrder'])->name('tickets.order');
    Route::get('/tickets/price', [TicketController::class, 'getTicketPrice'])->name('tickets.price');
    // Midtrans routes
    Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);
    Route::post('/payment/update-status', [PaymentController::class, 'updatePaymentStatus']);

    
    // History
    Route::get('/history', [HistoryController::class, 'history'])->name('history');
});

/*
|--------------------------------------------------------------------------
| Route untuk Admin (Hanya Bisa Diakses Jika Login sebagai Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Petugas
    Route::get('/petugas/index', [UserController::class, 'viewStaff'])->name('petugas.index');
    Route::get('/petugas/add', [UserController::class, 'createStaff'])->name('petugas.add');
    Route::post('/petugas/add', [UserController::class, 'storeStaffView'])->name('petugas.store');
    Route::get('/petugas/{id}/edit', [UserController::class, 'editStaff'])->name('petugas.edit');
    Route::put('/petugas/{id}', [UserController::class, 'updateStaff'])->name('petugas.update');
    Route::delete('/petugas/{id}', [UserController::class, 'destroyStaff'])->name('petugas.destroy');
    Route::post('/add-petugas', [UserController::class, 'addPetugas']);

    // Kelola Pengguna (User)
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/add', [UserController::class, 'create'])->name('user.add');
    Route::post('/user/add', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/add-user', [UserController::class, 'addUser']);

    // Kelola Tiket
    Route::get('/tiket/index', [TicketController::class, 'index'])->name('tiket.index');
    Route::get('/tiket/add', [TicketController::class, 'create'])->name('tiket.add');
    Route::post('/tiket/add', [TicketController::class, 'store'])->name('tiket.store');
    Route::get('/tiket/{id}/edit', [TicketController::class, 'edit'])->name('tiket.edit');
    Route::put('/tiket/{id}', [TicketController::class, 'update'])->name('tiket.update');
    Route::delete('/tiket/{id}', [TicketController::class, 'destroy'])->name('tiket.destroy');

    // Kelola Voucher
    Route::get('/voucher/index', [VoucherController::class, 'index'])->name('voucher.index');
    Route::get('/voucher/add', [VoucherController::class, 'create'])->name('voucher.add');
    Route::post('/voucher/add', [VoucherController::class, 'store'])->name('voucher.store');
    Route::get('/voucher/{id}/edit', [VoucherController::class, 'edit'])->name('voucher.edit');
    Route::put('/voucher/{id}', [VoucherController::class, 'update'])->name('voucher.update');
    Route::delete('/voucher/{id}', [VoucherController::class, 'destroy'])->name('voucher.destroy');

    // Report
    Route::get('/report', [ReportController::class, 'showReport'])->name('report');
    Route::get('/report/download', [ReportController::class, 'downloadPDF'])->name('report.download');

    // Transaksi (Jika perlu)
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/data', [TransactionController::class, 'getTransactionData'])->name('transaksi.data');
});

/*
|--------------------------------------------------------------------------
| Route untuk Petugas (Hanya Bisa Diakses Jika Login sebagai Petugas)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', PetugasMiddleware::class])->prefix('petugas')->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Route REST untuk User (CRUD oleh Admin)
|--------------------------------------------------------------------------
*/
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
