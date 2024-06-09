<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_keranjang',
        'id_user',
        'nama_barang',
        'total_harga',
        'status_submission',
        'status_payment',
        'created_at',
        'updated_at',
        'due_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang', 'id_keranjang');
    }
}
