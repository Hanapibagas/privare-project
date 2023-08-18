<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function getKategori2($id)
    {
        $kategori = ProductCategory::find($id);
        $products = Product::where('category_id', $id)->get();

        return view('components.pages.daftar-kategori', compact('products', 'kategori'));
    }
}
