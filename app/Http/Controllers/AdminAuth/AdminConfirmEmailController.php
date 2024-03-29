<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AdminConfirmEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user("admin")->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN.'?verified=1');
        }

        if ($request->user("admin")->markEmailAsVerified()) {
            event(new Verified($request->user("admin")));
        }

        return redirect()->intended(RouteServiceProvider::HOME_ADMIN.'?verified=1');
    }
}
