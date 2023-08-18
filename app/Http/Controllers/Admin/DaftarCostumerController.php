<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CustomEmail;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class DaftarCostumerController extends Controller
{
    public function index_costumer()
    {
        $users = User::where('id', '>', 2)->get();

        $totalTransactions = [];

        foreach ($users as $user) {
            $userId = $user->id;
            $jumlahPembelian = $user->transactions()->count();

            if (!isset($totalTransactions[$userId])) {
                $totalTransactions[$userId] = $jumlahPembelian;
            } else {
                $totalTransactions[$userId] += $jumlahPembelian;
            }
        }

        foreach ($users as $user) {
            $userId = $user->id;
            $totalPembelian = $totalTransactions[$userId] ?? 0;

            if ($totalPembelian >= 15) {
                $user->tanda = 'Platinum';
            } elseif ($totalPembelian >= 10) {
                $user->tanda = 'Gold';
            } elseif ($totalPembelian >= 5) {
                $user->tanda = 'Silver';
            } else {
                $user->tanda = 'Reguler';
            }

            $user->totalPembelian = $totalPembelian;
        }

        return view('components.admin.daftar-costumer.index', compact('users', 'totalTransactions'));
    }

    public function kirimEmailKeSeluruhUser(Request $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');

        // Mendapatkan semua pengguna
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new CustomEmail($subject, $message));
        }

        return redirect()->back()->with('success', 'Email telah dikirim ke seluruh pengguna.');
    }

    public function getPrintPDF(Request $request)
    {
        $users = User::where('id', '>', 2)->get();

        $totalTransactions = [];

        foreach ($users as $user) {
            $userId = $user->id;
            $jumlahPembelian = $user->transactions()->count();

            if (!isset($totalTransactions[$userId])) {
                $totalTransactions[$userId] = $jumlahPembelian;
            } else {
                $totalTransactions[$userId] += $jumlahPembelian;
            }
        }

        foreach ($users as $user) {
            $userId = $user->id;
            $totalPembelian = $totalTransactions[$userId] ?? 0;

            if ($totalPembelian >= 15) {
                $user->tanda = 'Platinum';
            } elseif ($totalPembelian >= 10) {
                $user->tanda = 'Gold';
            } elseif ($totalPembelian >= 5) {
                $user->tanda = 'Silver';
            } else {
                $user->tanda = 'Reguler';
            }

            $user->totalPembelian = $totalPembelian;
        }

        $pdf = PDF::loadview('components.admin.daftar-costumer.rekap-pdf', compact('users', 'totalTransactions'));

        return $pdf->stream('rekap.pdf');
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

        return redirect()->route('index_costumer')->with('status', 'Selamat Laporan cutomer berhasil dikirim');
    }
}
