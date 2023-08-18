<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class ListPertanyaanUserController extends Controller
{
    public function getIndex()
    {
        $list = Pertanyaan::all();

        return view('components.admin.list-pertanyaan.index', compact('list'));
    }
}
