<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route menuju dashboard user
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/testimonials', [DashboardController::class, 'storeTestimonial'])->name('testimonials.store');

// Rute untuk pengelolaan profil user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('list', [ProfileController::class, 'data'])->name('list');
});

// Rute untuk pengelolaan keranjang belanja
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id_barang}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::delete('/cart/delete/{id_keranjang}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
});

// Rute untuk pengelolaan booking
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/delete/{id_booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/bookings/update-payment-status/{id_booking}', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updatePaymentStatus');
    Route::post('/bookings/request-return/{id_booking}', [BookingController::class, 'requestReturn'])->name('bookings.requestReturn');
    Route::get('/bookings/invoice/submission/{id_booking}', [BookingController::class, 'MembuatFakturPengiriman'])->name('bookings.MembuatFakturPengiriman');
    Route::get('/bookings/invoice/return/{id_booking}', [BookingController::class, 'MembuatFakturPengembalian'])->name('bookings.MembuatFakturPengembalian');
    Route::get('/bookings/invoice/return-request/{id_booking}', [BookingController::class, 'MembuatFakturBuktiPengembalianDariUserKeAdmin'])->name('bookings.MembuatFakturBuktiPengembalianDariUserKeAdmin');
});

// Rute untuk pengelolaan admin
Route::get('/admin_home', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin_keuangan', [AdminController::class, 'keuangan'])->name('admin.keuangan');
Route::get('/admin_pelanggan', [AdminController::class, 'pelanggan'])->name('admin.pelanggan');
Route::get('/admin_transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
Route::post('/admin/confirm/{id_booking}', [AdminController::class, 'confirmSubmission'])->name('admin.confirmSubmission');
Route::post('/admin/bookings/confirm-return/{id_booking}', [AdminController::class, 'confirmReturn'])->name('admin.confirmReturn');
Route::post('/admin/reject-submission/{id_booking}', [AdminController::class, 'rejectSubmission'])->name('admin.rejectSubmission');

require __DIR__ . '/auth.php';