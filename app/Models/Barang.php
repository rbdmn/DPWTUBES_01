<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Keranjang;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'harga_barang',
        'foto_barang',
    ];

    // Define the relationship with the cart (keranjang)
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'id_barang', 'id_barang');
    }
}

?>