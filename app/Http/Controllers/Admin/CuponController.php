<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KirimEmail;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CuponController extends Controller
{
    public function index_cupon()
    {
        $cupon = Coupon::all();
        return view('components.admin.cupon.index', compact('cupon'));
    }

    public function create_cupon()
    {
        $users = User::all();
        return view('components.admin.cupon.create', compact('users'));
    }

    public function store_cupon(Request $request)
    {
        $message = [
            'required' => 'Mohon maaf anda lupa untuk mengisi ini dan harap anda mangisi terlebih dahulu'
        ];

        $this->validate($request, [
            'coupon_code' =>  'required',
            'expired' =>  'required',
            'status' =>  'required',
            'discount' =>  'required',
        ], $message);

        Coupon::create([
            'coupon_code' => $request->input('coupon_code'),
            'expired' => $request->input('expired'),
            'status' => $request->input('status'),
            'discount' => $request->input('discount'),
        ]);

        return redirect()->route('index_cupon')->with('status', 'Selamat data product berhasil ditambahkan');
    }

    public function edit_cupon(Request $request, $id)
    {
        $item = Coupon::findOrFail($id);
        $users = User::all();
        return view('components.admin.cupon.update', compact('item', 'users'));
    }

    public function update_cupon(Request $request, $id)
    {
        $data = $request->all();

        Coupon::findOrFail($id)->update($data);
        return redirect()->route('index_cupon')->with('status', 'Selamat kupon berhasil diubah');
    }

    public function destroy_cupon($id)
    {
        Coupon::findOrFail($id)->delete();
        return response()->json(['status' => 'Selamat data kupon berhasil dihapus']);
    }
}
