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
        return view('auth.register');
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // Default role
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::USER())->with('success', 'Welcome ' . $user->first_name);
    }

    
    public function loginCheckEmail(Request $request)
    {
        // Validate email format before querying DB
        $request->validate(['email' => 'required|email']);
        
        $emailExists = User::where('email', $request->email)->exists();
        return response()->json(['available' => !$emailExists]); // If false, email exists
    }


    // In RegisteredUserController.php
    public function checkEmail(Request $request)
    {
        // Validate email format before querying DB
        $request->validate(['email' => 'required|email']);

        $emailExists = User::where('email', $request->email)->exists();
        return response()->json(['available' => !$emailExists]);
    }
}
