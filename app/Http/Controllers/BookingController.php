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
        $keranjang = Keranjang::findOrFail($booking->id_keranjang);
        $barang = Barang::where('id_barang', $keranjang->id_barang)->firstOrFail();
        
        // Tambahkan jumlah barang kembali ke stok
        $barang->stok += $keranjang->jumlah_barang_sewa;  // Menggunakan jumlah barang sewa dari keranjang
        
        // Update status_ketersediaan jika stok bertambah
        if ($barang->stok > 0) {
            $barang->status_ketersediaan = true;
        }
        
        $barang->save();
        $booking->delete();

        return redirect()->back()->with('success', 'Booking di cancel dengan sukses');
    }

    // Menyimpan pemesanan dari keranjang ke dalam database
    public function store(Request $request)
    {
        $id_keranjang = $request->input('id_keranjang');
        $keranjang = Keranjang::where('id_keranjang', $id_keranjang)
            ->where('id_user', Auth::id())
            ->where('sudah_book', false)
            ->first();

        if ($keranjang) {
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
                    'status_payment' => 'Belum dibayar',
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                    'due_date' => $dueDate,
                ]);

                // Update status keranjang menjadi sudah dibooking
                $keranjang->update(['sudah_book' => true]);
            }
        }

        return redirect()->back()->with('success', 'Pemesanan telah berhasil dikirim!');
    }


    // Memperbarui status pembayaran pemesanan
    public function updatePaymentStatus(Request $request, $id_booking)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $booking = Booking::find($id_booking);

        if ($booking && $booking->status_payment == 'Belum dibayar') {
            $imageName = time().'.'.$request->bukti_pembayaran->extension();
            $request->bukti_pembayaran->move(public_path('bukti_pembayaran'), $imageName);

            $booking->status_payment = 'Terbayar';
            $booking->bukti_pembayaran = $imageName;
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Pembayaran sukses!');
    }


    // Melakukan pengembalian barang
    public function returnItem($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Sah') {
            // Logika untuk menangani tindakan pengembalian
            $booking->status_submission = 'Telah Dikembalikan';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Penyerahan barang sukses!');
    }

    // Meminta pengembalian barang
    public function requestReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == 'Sah') {
            $booking->status_submission = 'Permintaan Pengembalian';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Pengembalian barang sukses!');
    }

    // Membuat invoice pemesanan
    public function MembuatFakturPengiriman($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);

        // Kondisi ini untuk error handling jika booking tidak ditemukan
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking tidak ketemu.');
        }

        $pdf = PDF::loadView('invoices.submission', compact('booking'));
        return $pdf->download('Bukti_Penyerahan_' . $booking->user->name . '_.pdf');
    }

    // Membuat invoice pengembalian barang
    public function MembuatFakturPengembalian($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);

        // Kondisi ini untuk error handling jika booking tidak ditemukan
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking tidak ketemu.');
        }

        $pdf = Pdf::loadView('invoices.return', compact('booking'));
        return $pdf->download('Bukti_Pengembalian_' . $booking->user->name . '_.pdf');
    }

    // Mengunduh bukti pengembalian barang
    public function MembuatFakturBuktiPengembalianDariUserKeAdmin($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);

        // Pastikan booking ditemukan
        if (!$booking) {
            return redirect()->route('admin.home')->with('error', 'Booking tidak ditemukan.');
        }

        $pdf = PDF::loadView('invoices.buktipengembalianuserkeadmin', compact('booking'));
        return $pdf->download('Bukti_Pengembalian_' . $booking->user->name . '_' . time() . '.pdf');
    }

}
