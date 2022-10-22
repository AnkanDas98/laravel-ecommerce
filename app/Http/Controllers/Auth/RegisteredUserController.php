<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
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
            'name' => ['required', 'string', 'max:255'],
            'register_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', "min:11", 'unique:users'],
            'register_password' => ['required',  Rules\Password::defaults()],
            'register_password_confirmation' => ['required', 'same:register_password']
        ],[
          'register_email.required' => 'Email is required',
          'register_password.required' => 'Password is required',   
          'register_password_confirmation.required' => 'Password Confirmation field is required', 
          'register_password_confirmation.same' => 'Password and Confirm Password must match'  
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->register_email,
            'phone' => $request->phone,
            'password' => Hash::make($request->register_password),
        ]);

        $user->attachRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Logged In');
    }
}
