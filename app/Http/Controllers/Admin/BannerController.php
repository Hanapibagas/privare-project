<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index_banner()
    {
        $banner = Banner::all();

        return view('components.admin.banner.index', compact('banner'));
    }

    public function create_banner()
    {
        return view('components.admin.banner.create');
    }

    public function store_banner(Request $request)
    {
        if ($request->file('banner')) {
            $file = $request->file('banner')->store('banner', 'public');
        }

        Banner::create([
            'banner' => $file
        ]);

        return redirect()->route('index_banner')->with('status', 'Selamat data banner berhasil ditambahkan');
    }

    public function edit_banner(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->first();

        return view('components.admin.banner.update', compact('banner'));
    }

    public function update_banner(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->first();

        if ($request->file('banner')) {
            $file = $request->file('banner')->store('banner', 'public');
            if ($banner->banner && file_exists(storage_path('app/public/' . $banner->banner))) {
                Storage::delete('public/' . $banner->banner);
                $file = $request->file('banner')->store('banner', 'public');
            }
        }

        if ($request->file('banner') === null) {
            $file = $banner->banner;
        }

        $banner->update([
            'banner' => $file
        ]);

        return redirect()->route('index_banner')->with('status', 'Selamat data baner berhasil di update');
    }

    public function destroy_banner($id)
    {
        $delete = Banner::find($id);

        if ($delete->banner && file_exists(storage_path('app/public/' . $delete->banner))) {
            Storage::delete('public/' . $delete->banner);
        }

        $delete->delete();

        return response()->json(['status' => 'Selamat data infografis berhasil dihapus']);
    }
}
