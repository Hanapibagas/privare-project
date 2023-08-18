<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class GalleryProductController extends Controller
{
    public function index_gallery()
    {
        $gallery = ProductGallery::all();
        return view('components.admin.gallery-product.index', compact('gallery'));
    }

    public function create_gallery()
    {
        $product = Product::all();
        return view('components.admin.gallery-product.create', compact('product'));
    }

    public function store_gallery(Request $request)
    {
        $gambar = $request->file('name');

        if ($request->hasFile('name')) {
            foreach ($gambar as $file) {
                $path = $file->store('product-gallery', 'public');

                ProductGallery::create([
                    'product_id' => $request->input('product_id'),
                    'name' => $path
                ]);
            }
        }

        return redirect()->route('index_gallery')->with('status', 'Selamat data product gallery berhasil ditambahkan');
    }

    public function destroy_gallery($id)
    {
        $gambar = ProductGallery::where('id', $id)->first();

        if ($gambar->name && file_exists(storage_path('app/public/' . $gambar->name))) {
            Storage::delete('public/' . $gambar->name);
        }

        $gambar->delete();

        return response()->json(['status' => 'Selamat data product gallery berhasil dihapus']);
    }
}
