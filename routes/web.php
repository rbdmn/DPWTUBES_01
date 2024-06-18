<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route menuju dashboard user
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/testimonials', [DashboardController::class, 'TambahTestimoni'])->name('tambah-testimoni');

// Rute untuk pengelolaan profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('list', [ProfileController::class, 'data'])->name('list');
});

// Rute untuk pengelolaan keranjang belanja
Route::middleware(['auth'])->group(function () {
    Route::post('/keranjang/tambah/{id_barang}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::delete('/keranjang/hapus/{id_keranjang}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/keranjang/{id}', [CartController::class, 'update'])->name('cart.update');
});

// Rute untuk pengelolaan booking
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/hapus/{id_booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/bookings/update-status-pembayaran/{id_booking}', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updatePaymentStatus');
    Route::post('/bookings/izin-pengembalian-barang/{id_booking}', [BookingController::class, 'requestReturn'])->name('bookings.requestReturn');
    Route::get('/bookings/invoice/penyerahan/{id_booking}', [BookingController::class, 'MembuatFakturPengiriman'])->name('bookings.MembuatFakturPengiriman');
    Route::get('/bookings/invoice/pengembalian/{id_booking}', [BookingController::class, 'MembuatFakturPengembalian'])->name('bookings.MembuatFakturPengembalian');
    Route::get('/bookings/invoice/minta-pengembalian/{id_booking}', [BookingController::class, 'MembuatFakturBuktiPengembalianDariUserKeAdmin'])->name('bookings.MembuatFakturBuktiPengembalianDariUserKeAdmin');
    Route::get('/pembayaran/{id_keranjang}', [BookingController::class, 'showPaymentForm'])->name('payment');
    Route::post('/proses-pembayaran', [BookingController::class, 'processPayment'])->name('bookings.processPayment');
});

// Rute untuk pengelolaan admin
Route::get('/admin_home', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin_keuangan', [AdminController::class, 'keuangan'])->name('admin.keuangan');
Route::get('/admin_pelanggan', [AdminController::class, 'pelanggan'])->name('admin.pelanggan');
Route::get('/admin_transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
Route::post('/admin/konfirmasi/{id_booking}', [AdminController::class, 'confirmSubmission'])->name('admin.confirmSubmission');
Route::post('/admin/bookings/konfirmasi-pengembalian/{id_booking}', [AdminController::class, 'confirmReturn'])->name('admin.confirmReturn');
Route::post('/admin/tolak/{id_booking}', [AdminController::class, 'rejectSubmission'])->name('admin.rejectSubmission');

// Rute untuk login admin
Route::get('/admin/login', [AdminAuthController::class, 'LoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

require __DIR__ . '/auth.php';