<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Keranjang;

class Pembayaran extends Model
{
    protected $fillable = [
        'id_pembayaran',
        'id_keranjang',
        'total_harga',
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang');
    }
}

?>