<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'discount',
        'kode_pemesanan',
        'discount_price',
        'sub_total',
        'grand_total',
        'foto',
        'status',
        'nama_lengkap',
        'no_telpn',
        'alamat',
        'metode_pembayaran'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailsTransaksi::class, 'transaksi_id');
    }
}
