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
            ->where('status_payment', 'Paid')
            ->whereIn('status_submission', [
                'Pending',
                'Return Requested',
                'Confirmed',
                'Returned',
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
        if ($booking && $booking->status_payment == 'Paid') {
            $booking->status_submission = 'Confirmed';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Penyerahan telah berhasil di konfirm!');
    }

    // Mengonfirmasi pengembalian barang
    public function confirmReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Return Requested') {
            $booking->status_submission = 'Returned';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Pengembalian telah berhasil di konfirm!');
    }

    // Menolak penerimaan pemesanan
    public function rejectSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Pending') {
            $booking->status_submission = 'Rejected';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Penyerahan telah berhasil di tolak.');
    }
}
