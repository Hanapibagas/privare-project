<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo;
    public function redirectTo()
    {
        switch (Auth::user()->roles) {
            case "admin";
                $this->redirectTo = '/dashboard-admin';
                return $this->redirectTo;
                break;
            case "owner";
                $this->redirectTo = '/dashboard-owner';
                return $this->redirectTo;
                break;
        }
    }

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
}
