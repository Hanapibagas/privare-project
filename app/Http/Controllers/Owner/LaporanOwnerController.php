<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanOwnerController extends Controller
{
    public function getIndex()
    {
        $laporan = Laporan::all();
        return view('components.owner.daftar-laparan.index', compact('laporan'));
    }
}
