<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{

    public function login()
    {
        return view('adminAuth.admin-login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate('admin');

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
