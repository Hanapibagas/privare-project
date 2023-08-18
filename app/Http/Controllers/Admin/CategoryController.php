<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index_category()
    {
        $category = ProductCategory::all();
        return view('components.admin.category.index', compact('category'));
    }

    public function create_cataegory()
    {
        return view('components.admin.category.create');
    }

    public function store_category(Request $request)
    {
        $message = [
            'required' => 'Mohon maaf anda lupa untuk mengisi ini dan harap anda mangisi terlebih dahulu'
        ];

        $this->validate($request, [
            'name' => 'required'
        ], $message);

        ProductCategory::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('index_category')->with('status', 'Selamat data kategori berhasil ditambahkan');
    }

    public function edit_category(Request $request, $id)
    {
        $files = ProductCategory::where('id', $id)->first();
        return view('components.admin.category.update', compact('files'));
    }

    public function update_category(Request $request, $id)
    {
        $files = ProductCategory::where('id', $id)->first();
        $files->update([
            'name' => $request->input('name')
        ]);
        return redirect()->route('index_category')->with('status', 'Selamat data kategori berhasil ditambahkan');
    }

    public function destroy_category($id)
    {
        $delete = ProductCategory::find($id);
        $delete->delete();
        return response()->json(['status' => 'Selamat data category berhasil dihapus']);
    }
}
