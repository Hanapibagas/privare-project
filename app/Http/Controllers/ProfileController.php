<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $users = Auth::user();
        return view('components.pages.update-profile', compact('users'));
    }

    public function getUpdatePaswword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->no_telpon = $request->no_telpon;
        $user->alamat = $request->alamat;
        $user->email = $request->email;
        // $user->password = $request->password;
        $user->password = bcrypt($request->password);

        // dd($user);
        $user->save();


        return redirect()->route('index-profile')->with('status', 'Selamat data profile anda berhasil diperbarui');
    }
}
