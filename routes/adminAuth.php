<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\AdminAuthController;
use App\Http\Controllers\AdminAuth\RegisterAdminUserController;
use App\Models\Admin;
use App\Http\Controllers\AdminAuth\AdminSendEmailController;
use App\Http\Controllers\AdminAuth\AdminNotifyEmailController;
use App\Http\Controllers\AdminAuth\AdminConfirmEmailController;

Route::prefix('admin')->group( function(){
    Route::name('admin.')->group(function () {
Route::middleware('guest:admin')->group(function () {

    Route::get('login', [AdminAuthController::class, 'login'])
->name('login');

Route::post('login', [AdminAuthController::class, 'store']);


//     Route::get('register', [RegisteredUserController::class, 'create'])
// ->name('register');

// Route::post('register', [RegisteredUserController::class, 'store']);


//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->name('password.request');

//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->name('password.email');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->name('password.reset');

//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//                 ->name('password.update');
});
});
});



//Route::name('admin')->group(function () {
Route::middleware('auth:admin')->group(function () {
    Route::get('/verify-email', [AdminSendEmailController::class, '__invoke'])
                ->name('send.email');//verification.notice

    Route::get('verify-email/{id}/{hash}', [AdminConfirmEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');//verification.verify

    Route::post('email/verification-notification', [AdminNotifyEmailController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('email.out');//verification.send

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //             ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::match(['post','get'], 'logout', [AdminAuthController::class, 'destroy'])->name('logout');

});
//});

