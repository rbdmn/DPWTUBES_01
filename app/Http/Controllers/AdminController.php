<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Barang;
use App\Models\Keranjang;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Menampilkan halaman utama admin dengan data pemesanan yang telah dibayar
    public function home()
    {
        $Status_Bookingnya = Booking::with('user')
            ->where('status_payment', 'Terbayar')
            ->whereIn('status_submission', [
                'Pending',
                'Permintaan Pengembalian',
                'Sah',
                'Telah Dikembalikan',
            ])
            ->get();

        return view('admin.home', compact('Status_Bookingnya'));
    }

    // Menampilkan halaman keuangan admin dengan total pendapatan dari pemesanan yang telah dibayar
    public function keuangan()
    {
        $totalHarga = Booking::where('status_submission', '!=', 'Ditolak')
                    ->where('status_payment', 'Terbayar')
                    ->sum('total_harga');
        return view('admin.keuangan', compact('totalHarga'));
    }

    // Menampilkan halaman daftar pelanggan user
    public function pelanggan()
    {
        $pelanggan = User::leftJoin('bookings', 'users.id', '=', 'bookings.id_user')
                        ->select('users.*', DB::raw('COUNT(bookings.id_booking) as total_booking'))
                        ->groupBy('users.id')
                        ->get();

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
        if ($booking && $booking->status_payment == 'Terbayar') {
            $booking->status_submission = 'Sah';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Penyerahan telah berhasil di konfirm!');
    }

    // Mengonfirmasi pengembalian barang
    public function confirmReturn($id_booking)
    {
        // Mencari booking berdasarkan id_booking
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Permintaan Pengembalian') {
            // Update status booking
            $booking->status_submission = 'Telah Dikembalikan';
            $booking->save();

            // Mencari keranjang terkait dengan booking ini
            $keranjang = Keranjang::find($booking->id_keranjang);
            if ($keranjang) {
                // Mencari barang terkait dengan keranjang ini
                $barang = Barang::find($keranjang->id_barang);
                if ($barang) {
                    // Mengembalikan stok barang
                    $barang->stok += $keranjang->jumlah_barang_sewa;
                    $barang->save();
                }
            }
        }

        return redirect()->route('admin.home')->with('success', 'Pengembalian telah berhasil dikonfirmasi!');
    }

    // Menolak penerimaan pemesanan
    public function rejectSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Pending') {
            $booking->status_submission = 'Ditolak';
            $booking->status_payment = 'Uang Dibalikkan';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Penyerahan telah berhasil di tolak.');
    }
}
