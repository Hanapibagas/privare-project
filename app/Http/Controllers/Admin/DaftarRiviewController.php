<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiviewProduct;
use Illuminate\Http\Request;

class DaftarRiviewController extends Controller
{
    public function getIndex()
    {
        $riview = RiviewProduct::all();
        return view('components.admin.riview.index', compact('riview'));
    }

    public function getDetails(Request $request, $id)
    {
        $riview = RiviewProduct::where('id', $id)->first();
        return view('components.admin.riview.details', compact('riview'));
    }
}
