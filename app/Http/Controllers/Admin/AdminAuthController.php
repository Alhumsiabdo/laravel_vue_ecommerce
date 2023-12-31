<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function Login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => true]))
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Invalid credentials. ');
    }

    public function logout(Request $request)
    {
        
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
        
    }
}
