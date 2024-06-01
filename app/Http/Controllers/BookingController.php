<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Booking;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('id_user', Auth::id())->get();
        return view('booking', compact('bookings'));
    }
    
    public function store(Request $request)
    {
        $keranjangs = Keranjang::where('id_user', Auth::id())->get();

        foreach ($keranjangs as $keranjang) {
            // Fetch the harga_barang from the barangs table
            $barang = Barang::find($keranjang->id_barang);
            if ($barang) {
                $total_harga = $barang->harga_barang * $keranjang->jumlah_barang_sewa;

                Booking::create([
                    'id_user' => Auth::id(),
                    'id_keranjang' => $keranjang->id_keranjang,
                    'nama_barang' => $keranjang->nama_barang_sewa,
                    'total_harga' => $total_harga,
                    'status_submission' => 'Pending',
                    'status_payment' => 'Unpaid',
                ]);
            }
        }

        return redirect()->route('booking')->with('success', 'All items have been submitted!');
    }

    public function updatePaymentStatus($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_payment == Booking::PAYMENT_UNPAID) {
            $booking->status_payment = Booking::PAYMENT_PAID;
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Payment status updated successfully!');
    }

    public function returnItem($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_CONFIRMED) {
            // Logic for handling the return action
            $booking->status_submission = 'Returned';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Item returned successfully!');
    }

    public function requestReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_CONFIRMED) {
            $booking->status_submission = Booking::STATUS_RETURN_REQUESTED;
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Return requested successfully!');
    }
}
?>
