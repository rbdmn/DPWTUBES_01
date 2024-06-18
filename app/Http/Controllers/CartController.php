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
        $barang = Barang::where('id_barang', $keranjang->id_barang)->firstOrFail();
        
        // Tambahkan jumlah barang kembali ke stok
        $barang->stok += $keranjang->jumlah_barang_sewa;
        
        // Update status_ketersediaan jika stok bertambah
        if ($barang->stok > 0) {
            $barang->status_ketersediaan = true;
        }
        
        $barang->save();
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

        if ($barang->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk menambah ke keranjang!');
        }

        $keranjang = new Keranjang();
        $keranjang->id_user = $user->id;
        $keranjang->id_barang = $barang->id_barang;
        $keranjang->nama_barang_sewa = $barang->nama_barang;
        $keranjang->jumlah_barang_sewa = $request->quantity;

        $barang->stok -= $request->quantity;
        if ($barang->stok == 0) {
            $barang->status_ketersediaan = false;
        }
        $barang->save();

        $keranjang->save();

        return redirect()->back()->with('success', 'Barang telah ditambahkan ke keranjang!!');
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang && $keranjang->id_user == Auth::id() && $keranjang->sudah_book == 0) {
            $keranjang->update([
                'durasi' => $request->input('durasi'),
            ]);
        }

        return redirect()->back()->with('error', 'Gagal untuk mengubah durasi');
    }
}
