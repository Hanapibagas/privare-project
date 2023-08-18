<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DetailsTransaksi;
use Illuminate\Http\Request;
use PDF;

class TransaksiOwnerController extends Controller
{
    public function getIndex()
    {
        $transaksi = DetailsTransaksi::all();

        return view('components.owner.tranasksi-costumer.index', compact('transaksi'));
    }

    public function getExportPDF(Request $request)
    {
        $dari = $request->input('dari');
        $ke = $request->input('ke');

        $detailsTransaksi = DetailsTransaksi::whereBetween('order_date', [$dari, $ke])->get();

        $total = $detailsTransaksi->sum('selling_price');
        $purchase_price = $detailsTransaksi->sum('purchase_price');
        $profit = $detailsTransaksi->sum('profit');

        view()->share('rekap', $detailsTransaksi);
        view()->share('total', $total);
        view()->share('total', $purchase_price);
        view()->share('total', $profit);

        $pdf = PDF::loadview('components.owner.tranasksi-costumer.rekap-pdf', compact('detailsTransaksi', 'total', 'purchase_price', 'profit'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap.pdf');

        // $dari = $request->input('dari');
        // $ke = $request->input('ke');

        // $detailsTransaksi = DetailsTransaksi::whereBetween('order_date', [$dari, $ke])->get();

        // view()->share('rekap', $detailsTransaksi);

        // $pdf = PDF::loadview('components.owner.tranasksi-costumer.rekap-pdf', compact('detailsTransaksi'))->setPaper('a4', 'landscape');

        // return $pdf->stream('rekap.pdf');
    }
}
