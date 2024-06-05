<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $cart = Keranjang::with('barang')
            ->where('id_user', auth()->id())
            ->get();

        return view('keranjang', compact('cart'));
    }

    public function destroy($id_keranjang)
    {
        $keranjang = Keranjang::findOrFail($id_keranjang);
        $keranjang->delete();
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function add(Request $request, $id_barang)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $barang = Barang::where('id_barang', $id_barang)->firstOrFail();

        $keranjang = new Keranjang();
        $keranjang->id_user = $user->id;
        $keranjang->id_barang = $barang->id_barang;
        $keranjang->nama_barang_sewa = $barang->nama_barang;
        $keranjang->jumlah_barang_sewa = $request->quantity;

        $keranjang->save();

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang && $keranjang->id_user == Auth::id() && $keranjang->sudah_book == 0) {
            $keranjang->update([
                'durasi' => $request->input('durasi'),
            ]);

            // return redirect()->back()->with('success', 'Durasi updated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to update durasi!');
    }
}
