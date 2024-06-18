<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $testimonials = Testimonial::with('user')->get();
        return view('dashboard', compact('barangs', 'testimonials'));
    }

    public function TambahTestimoni(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $testimonial = new Testimonial([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        $testimonial->save();

        return redirect()->back()->with('success', 'Review berhasil di submit!');
    }
}
