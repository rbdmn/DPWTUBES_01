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
    // public function index()
    // {
    //     // Fetch cart items from the database using a join operation
    //     $cart = DB::table('keranjangs')
    //         ->join('barangs', 'keranjangs.id_barang', '=', 'barangs.id_barang')
    //         ->where('keranjangs.id', auth()->id())
    //         ->select('keranjangs.id_keranjang', 'keranjangs.id', 'keranjangs.nama_barang_sewa', 'barangs.harga_barang', 'keranjangs.jumlah_barang_sewa')
    //         ->get();

    //     // Pass the cart data to the view
    //     return view('keranjang', ['cart' => $cart]);
    // }

    public function update(Request $request)
    {
        $cart = Keranjang::where('id', Auth::id())->first();
        $item = $cart->items()->find($request->input('id'));
        $item->update(['jumlah_barang_sewa' => $request->input('quantity')]);
        return redirect()->route('keranjang');
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
}
