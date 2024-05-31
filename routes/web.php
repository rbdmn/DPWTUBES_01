<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('list', function () {
//     return view('listproducts');
// })->name('list');

// Route::get('list', 'BarangController@data');
Route::get('list', [ProfileController::class, 'data'])->name('list');

// Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// Route::post('/addToCart/{id}', [BookingController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add/{id_barang}', [CartController::class, 'add'])->name('cart.add');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');

Route::delete('/cart/delete/{id_keranjang}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id_booking}/pay', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updatePaymentStatus');
    Route::post('/bookings/return-item/{id_booking}', [BookingController::class, 'returnItem'])->name('bookings.returnItem');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/confirm/{id_booking}', [AdminController::class, 'confirmSubmission'])->name('admin.confirmSubmission');

require __DIR__.'/auth.php';
