<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class AdminSendEmailController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user("admin")->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME_ADMIN)
                    : view('adminAuth.admin-verifyEmail');
    }
}
