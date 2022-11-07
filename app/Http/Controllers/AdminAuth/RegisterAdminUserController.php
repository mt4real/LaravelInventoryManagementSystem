<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;


class RegisterAdminUserController extends Controller
{

    public function superAdminCreate(){
        return view('adminAuth.admin-reg');
    }

    public function superAdminStore(Request $request){

        $request->validate([
            'name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','required_with:confirmation_password','same:confirmation_password', Password::default()],
            'confirmation_password'=>['required',Password::default()],
        ]);

        $role_id=Role::where(['role_name'=>Role::SUPER_ADMIN])->first();

        $user=new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->role_id=$role_id->id;
         $user->save();
        event(new Registered($user));

        return redirect()->intended(RouteServiceProvider::HOME_ADMIN);

    }


}
