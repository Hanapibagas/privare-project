<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RiviewProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiviewProductController extends Controller
{
    public function getRiviewProduct()
    {
        $product = Product::all();
        return view('components.pages.riview-product', compact('product'));
    }

    public function getStoreRiview(Request $request)
    {
        $user = Auth::id();
        RiviewProduct::create([
            'user_id' => $user,
            'product_id' => $request->input('product_id'),
            'ulasan' => $request->input('ulasan')
        ]);

        return redirect()->route('category1')->with('status', 'Selamat data riview product anda berhasil');
    }
}
