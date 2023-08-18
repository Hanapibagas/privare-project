<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date', 'product_id', 'jumlah_barang', 'selling_price', 'discount', 'purchase_price', 'profit', 'transaksi_id'
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tranaksi()
    {
        return $this->belongsTo(Transaction::class, 'transaksi_id');
    }
}
