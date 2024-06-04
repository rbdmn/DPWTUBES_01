<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Booking;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('id_user', Auth::id())->get();
        return view('booking', compact('bookings'));
    }

    public function destroy($id_booking)
    {
        $booking = Booking::findOrFail($id_booking);
        $booking->delete();
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function store(Request $request)
    {
        $keranjangs = Keranjang::where('id_user', Auth::id())->where('sudah_book', false)->get();

        foreach ($keranjangs as $keranjang) {
            // Fetch the harga_barang from the barangs table
            $barang = Barang::find($keranjang->id_barang);
            if ($barang) {
                $total_harga = $barang->harga_barang * $keranjang->jumlah_barang_sewa;
                $currentTimestamp = now(); // Get the current timestamp

                Booking::create([
                    'id_user' => Auth::id(),
                    'id_keranjang' => $keranjang->id_keranjang,
                    'nama_barang' => $keranjang->nama_barang_sewa,
                    'total_harga' => $total_harga,
                    'status_submission' => 'Pending',
                    'status_payment' => 'Unpaid',
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ]);

                // Update the keranjang to mark it as booked
                $keranjang->update(['sudah_book' => true]);
            }
        }

        return redirect()->back()->with('success', 'All items have been submitted!');
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
        if ($booking && $booking->status_submission == 'Confirmed') {
            $booking->status_submission = 'Return Requested';
            $booking->save();
        }

        return redirect()->route('booking')->with('success', 'Return requested successfully!');
    }

    public function generateSubmissionInvoice($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking not found.');
        }

        $pdf = PDF::loadView('invoices.submission', compact('booking'));
        return $pdf->download('submission_invoice_' . $booking->id_booking . '.pdf');
    }

    public function generateReturnInvoice($id_booking)
    {
        $booking = Booking::with(['user', 'keranjang'])->find($id_booking);
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Booking not found.');
        }

        $pdf = Pdf::loadView('invoices.return', compact('booking'));
        return $pdf->download('return_invoice_' . $booking->id_booking . '.pdf');
    }
}
