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

    const STATUS_PENDING = 'Pending';
    const STATUS_CONFIRMED = 'Confirmed';
    const STATUS_RETURN_REQUESTED = 'Return Requested';
    const STATUS_RETURNED = 'Returned';
    const PAYMENT_UNPAID = 'Unpaid';
    const PAYMENT_PAID = 'Paid';
}
