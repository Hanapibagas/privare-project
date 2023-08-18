<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code', 'photo', 'deskripsi', 'name', 'selling_price',
        'purchase_price', 'stock', 'category_id'
    ];

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
