<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_index()
    {
        $producy = Product::count();
        // $user = User::count();
        $diproses = Transaction::where('status', '0')->count();
        $diterima = Transaction::where('status', '1')->count();

        $users = User::withCount('transactions')->get();

        $usersSilver = 0;
        $usersGold = 0;
        $usersPlatinum = 0;

        foreach ($users as $user) {
            $totalPembelian = $user->transactions_count;

            if ($totalPembelian >= 15) {
                $usersPlatinum++;
            } elseif ($totalPembelian >= 10) {
                $usersGold++;
            } elseif ($totalPembelian >= 5) {
                $usersSilver++;
            }
        }


        return view('components.admin.dashboard', compact('producy', 'diproses', 'diterima', 'usersSilver', 'usersGold', 'usersPlatinum'));
    }
}
