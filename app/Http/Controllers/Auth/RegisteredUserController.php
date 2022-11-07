<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('adminAuth.admin-reg');
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|max:255|regex:/^([a-zA-Z' ]+)$/",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','required_with:confirmation_password','same:confirmation_password', Password::default()],
            'confirmation_password'=>['required',Password::default()],
        ]);

        $role_id=Role::where(['role_name'=>Role::SUPER_ADMIN])->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'=>$role_id->id,
        ]);

        event(new Registered($user));

       Auth::login($user);

        return redirect(RouteServiceProvider::HOME_ADMIN);
    }
    }
