<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Booking;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    // Menampilkan halaman daftar pemesanan pengguna
    public function index()
    {
        $bookings = Booking::where('id_user', Auth::id())->get();
        return view('booking', compact('bookings'));
    }

    // Menghapus pemesanan berdasarkan ID
    public function destroy($id_booking)
    {
        $booking = Booking::findOrFail($id_booking);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking di cancel dengan sukses');
    }

    // Menyimpan pemesanan dari keranjang ke dalam database
    public function store(Request $request)
    {
        $keranjangs = Keranjang::where('id_user', Auth::id())->where('sudah_book', false)->get();

        foreach ($keranjangs as $keranjang) {
            
            $barang = Barang::find($keranjang->id_barang);
            if ($barang) {
                $total_harga = ($barang->harga_barang * $keranjang->jumlah_barang_sewa) * $keranjang->durasi;
                $currentTimestamp = now(); 

                // Menghitung tanggal jatuh tempo
                $dueDate = $currentTimestamp->copy()->addDays($keranjang->durasi);

                // Membuat pemesanan baru
                Booking::create([
                    'id_user' => Auth::id(),
                    'id_keranjang' => $keranjang->id_keranjang,
                    'nama_barang' => $keranjang->nama_barang_sewa,
                    'total_harga' => $total_harga,
                    'status_submission' => 'Pending',
                    'status_payment' => 'Unpaid',
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                    'due_date' => $dueDate,
                ]);

                // Update status keranjang menjadi sudah dibooking
                $keranjang->update(['sudah_book' => true]);
            }
        }

        return redirect()->back()->with('success', 'Semua pemesanan pada keranjang telah berhasil di kirim!');
    }

    // Memperbarui status pembayaran pemesanan
    public function updatePaymentStatus($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_payment == 'Unpaid') {
            $booking->status_payment = 'Paid';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Pembayaran sukses!');
    }

    // Melakukan pengembalian barang
    public function returnItem($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Confirmed') {
            // Logika untuk menangani tindakan pengembalian
            $booking->status_submission = 'Returned';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Penyerahan barang sukses!');
    }

    // Meminta pengembalian barang
    public function requestReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Confirmed') {
            $booking->status_submission = 'Return Requested';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Pengembalian barang sukses!');
    }

    // Membuat invoice pemesanan
    public function generateSubmissionInvoice($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);

        // Kondisi ini untuk error handling jika booking tidak ditemukan
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking tidak ketemu.');
        }

        $pdf = PDF::loadView('invoices.submission', compact('booking'));
        return $pdf->download('Bukti_Penyerahan[' . $booking->nama_barang . '].pdf');
    }

    // Membuat invoice pengembalian barang
    public function generateReturnInvoice($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);

        // Kondisi ini untuk error handling jika booking tidak ditemukan
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking tidak ketemu.');
        }

        $pdf = Pdf::loadView('invoices.return', compact('booking'));
        return $pdf->download('Bukti_Pengembalian[' . $booking->nama_barang . '].pdf');
    }
}
