<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(4);
        $banner = Banner::all();
        $kategory = ProductCategory::all();
        return view('components.pages.home', compact('product', 'kategory', 'banner'));
    }
}
