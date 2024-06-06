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

        // Debugging the retrieved data
        // dd($paidBookings);

        return view('admin.home', compact('paidBookings'));
    }

    public function keuangan()
    {
        $totalHarga = Booking::where('status_submission', '!=', 'Rejected')->sum('total_harga');
        return view('admin.keuangan', compact('totalHarga'));
    }

    
    public function pelanggan()
    {
        $pelanggan = User::all(); // Mengambil semua data pelanggan
        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function transaksi()
    {
        // Mengambil data barang terlaris
        $barangTerlaris = Keranjang::select('id_barang', DB::raw('SUM(jumlah_barang_sewa) as total_penjualan'))
                                    ->groupBy('id_barang')
                                    ->orderByDesc('total_penjualan')
                                    ->limit(8) // Ambil 5 barang terlaris
                                    ->get();

        return view('admin.transaksi', compact('barangTerlaris'));
    }

    public function index()
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

        // Debugging the retrieved data
        // dd($paidBookings);

        return view('admin.home', compact('paidBookings'));
    }

    public function confirmSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_payment == Booking::PAYMENT_PAID) {
            $booking->status_submission = Booking::STATUS_CONFIRMED;
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Submission confirmed successfully!');
    }

    public function confirmReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_RETURN_REQUESTED) {
            $booking->status_submission = Booking::STATUS_RETURNED;
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Return confirmed successfully!');
    }

    public function rejectSubmission($id_booking)
    {
        // Add your logic to handle the rejection of the loan submission
        // You can update the booking status or perform any other necessary actions
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_PENDING) {
            $booking->status_submission = 'Rejected';
            $booking->save();
        }

        return redirect()->route('admin.home')->with('success', 'Loan submission has been rejected.');
    }
}
