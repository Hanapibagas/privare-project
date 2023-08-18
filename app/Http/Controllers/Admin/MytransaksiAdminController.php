<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailsTransaksi;
use App\Models\Laporan;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MytransaksiAdminController extends Controller
{
    public function getIndex()
    {
        $transaksi = Transaction::orderBy('created_at', 'desc')->get();
        return view('components.admin.tranasksi-costumer.index', compact('transaksi'));
    }

    public function getPembaruan(Request $request, $id)
    {
        $test = Transaction::where('id', $id)->first();

        $test->update([
            'status' => $request->status
        ]);

        return redirect()->route('index-transaksi')->with('status', 'Selamat data transaksi berhasil di update');
    }

    public function storeLaporan(Request $request)
    {
        if ($request->file('file')) {
            $file = $request->file('file')->store('file-laporan', 'public');
        }

        Laporan::create([
            'ket' => $request->input('ket'),
            'file' => $file
        ]);

        return redirect()->route('index-transaksi')->with('status', 'Selamat Laporan transaksi berhasil dikirim');
    }
}
