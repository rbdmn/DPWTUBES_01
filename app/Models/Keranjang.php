<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Keranjang extends Model
{
    protected $table = 'keranjangs';
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_keranjang',
        'id_user',
        'id_barang',
        'nama_barang_sewa',
        'jumlah_barang_sewa',
        'durasi',
        'created_at',
        'updated_at',
        'sudah_book',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Define the relationship with the items in the cart
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function booking()
    {
        return $this->hasOne(Booking::class, 'id_keranjang');
    }
}