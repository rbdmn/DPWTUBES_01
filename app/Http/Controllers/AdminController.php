<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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

        return view('admin.index', compact('paidBookings'));
    }

    public function confirmSubmission($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_payment == Booking::PAYMENT_PAID) {
            $booking->status_submission = Booking::STATUS_CONFIRMED;
            $booking->save();
        }

        return redirect()->route('admin.index')->with('success', 'Submission confirmed successfully!');
    }

    public function confirmReturn($id_booking)
    {
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_RETURN_REQUESTED) {
            $booking->status_submission = Booking::STATUS_RETURNED;
            $booking->save();
        }

        return redirect()->route('admin.index')->with('success', 'Return confirmed successfully!');
    }

    public function rejectSubmission($id_booking)
    {
        // Add your logic to handle the rejection of the loan submission
        // You can update the booking status or perform any other necessary actions
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status_submission == Booking::STATUS_CONFIRMED) {
            $booking->status_submission = 'Rejected';
            $booking->save();
        }
        
        return redirect()->route('admin.index')->with('success', 'Loan submission has been rejected.');
    }

    
}
