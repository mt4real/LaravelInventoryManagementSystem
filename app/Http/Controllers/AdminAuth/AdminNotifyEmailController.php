<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class AdminNotifyEmailController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
        }

        $request->user('admin')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
