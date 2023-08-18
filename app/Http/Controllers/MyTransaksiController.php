<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Mail\TransactionNotification;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyTransaksiController extends Controller
{
    public function getIndex()
    {
        $user = Auth::user();
        $transaksi = Transaction::where('user_id', $user->id)->count();

        if ($transaksi >= 5) {
            if ($transaksi >= 15) {
                $tanda = 'Platinum';
            } elseif ($transaksi >= 10) {
                $tanda = 'Gold';
            } else {
                $tanda = 'Silver';
            }

            if ($user->tanda !== $tanda) {
                $user->tanda = $tanda;
            }
        }

        if ($transaksi == 5 || $transaksi == 10 || $transaksi == 15) {
            Mail::to($user->email)->send(new TransactionNotification($transaksi));

            // if (Coupon::where('user_id', $user->id)->exists()) {
            if ($transaksi >= 15 && !Coupon::where('coupon_code', "Platinum")->exists()) {
                Coupon::create([
                    'user_id' => $user->id,
                    'coupon_code' => 'Platinum',
                    'discount' => '35'
                ]);
            }
            if ($transaksi >= 10 && !Coupon::where('coupon_code', "Gold")->exists()) {
                Coupon::create([
                    'user_id' => $user->id,
                    'coupon_code' => 'Gold',
                    'discount' => '20'
                ]);
            }
            if ($transaksi >= 5 && !Coupon::where('coupon_code', "Silver")->exists()) {
                Coupon::create([
                    'user_id' => $user->id,
                    'coupon_code' => 'Silver',
                    'discount' => '10'
                ]);
            }
            // }
        }

        $transaksi = Transaction::where('user_id', $user->id)->get();

        return view('components.pages.my-transaksi', compact('transaksi', 'user'));
    }

    public function getUpdate(Request $request, $id)
    {
        $transaksi = Transaction::find($id);

        if ($transaksi) {
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $path = $file->store('bukti-pembayaran', 'public');

                // if ($transaksi->foto) {
                //     Storage::disk('public')->delete($transaksi->foto);
                // }

                $transaksi->foto = $path;
                $transaksi->save();
            }
        }
        // dd($transaksi);

        return redirect()->back()->with('status', 'Selamat data banner berhasil ditambahkan');
    }
}
