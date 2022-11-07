<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class AuthenticatedAdminSessionController extends Controller
{
    public function superAdminCreate(){

        $user=new User();
        if($user->count()<1){

            return view('adminAuth.admin-login');


        }

        return redirect()->route('register');

    }

    public function superAdminStore(LoginRequest $request){

        // try{

        // $data = $request->all();

        // $email = $data['email'];

        // $password = $data['password'];

        // $remember = $request->has('remember') ? true : false;

        // $userType = new User();

        // if (empty($email) || empty($password)){

        // return redirect()->back()->with('flash_message_error','Kindly supply your login Credentials');

        // }

        // if (Auth::attempt(['email'=> $email, 'password'=> $password, 'user_status'=>User::USER_ACTIVE], $remember)){


        // if(!$userType->hasVerifiedEmail()){

        // return redirect()->route('verification.notice');
        // }

        // //Session::put('BackSession', $email);
        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);

        // }else{

        // return redirect()->back()->with('flash_message_error',' Access Denied');

        // }

        // return redirect()->back()->with('flash_message_error',' Invalid Email or Password');
        // }
        // catch (\Exception $e) {

        // return response()->json(['message' => $e->getMessage()]);
        // }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

         }

}
