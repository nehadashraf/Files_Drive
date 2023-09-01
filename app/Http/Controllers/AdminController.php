<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('adminPage');
    }
    public function goToLoginPageAdmin()
    {
        return view('auth.adminLogin');
    }
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        )) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.loginPage');
        }
    }
}
