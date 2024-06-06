<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan halaman utama admin dengan data pemesanan yang telah dibayar
    public function home()
    {
        $paidBookings = Booking::with('user')
            ->where('status_payment', Booking::PAYMENT_PAID)
            ->whereIn('status_submission', [
                Booking::STATUS_PENDING,
                Booking::STATUS_RETURN_REQUESTED,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_RETURNED,
            ])
            ->get();

        return view('admin.home', compact('paidBookings'));
    }

    // Menampilkan halaman keuangan admin dengan total pendapatan dari pemesanan yang telah dibayar
    public function keuangan()
    {
        $totalHarga = Booking::where('status_submission', '!=', 'Rejected')
                    ->where('status_payment', 'Paid')
                    ->sum('total_harga');
        return view('admin.keuangan', compact('totalHarga'));
    }

    // Menampilkan halaman daftar pelanggan user
    public function pelanggan()
    {
        $pelanggan = User::all(); // Mengambil semua data pelanggan
        return view('admin.pelanggan', compact('pelanggan'));
    }

    // Menampilkan halaman transaksi admin dengan daftar barang terlaris
    public function transaksi()
    {
        // Mengambil data barang terlaris
        $barangTerlaris = Keranjang::select('id_barang', DB::raw('SUM(jumlah_barang_sewa) as total_penjualan'))
                                    ->groupBy('id_barang')
                                    ->orderByDesc('total_penjualan')
                                    ->limit(10)
                                    ->get();

        return view('admin.transaksi', compact('barangTerlaris'));
    }

    // Mengonfirmasi penerimaan pemesanan
    public function confirmSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_payment == Booking::PAYMENT_PAID) {
            $booking->status_submission = Booking::STATUS_CONFIRMED;
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Submission confirmed successfully!');
    }

    // Mengonfirmasi pengembalian barang
    public function confirmReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_RETURN_REQUESTED) {
            $booking->status_submission = Booking::STATUS_RETURNED;
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Return confirmed successfully!');
    }

    // Menolak penerimaan pemesanan
    public function rejectSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_PENDING) {
            $booking->status_submission = 'Rejected';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Loan submission has been rejected.');
    }
}
