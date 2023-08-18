<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $diproses = Transaction::where('status', '0')->count();
        $diterima = Transaction::where('status', '1')->count();
        return view('components.owner.dashboard', compact('diproses', 'diterima'));
    }
}
