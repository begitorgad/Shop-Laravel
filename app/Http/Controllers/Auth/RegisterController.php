<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show the register form
    public function showForm()
    {
        session(['url.intended' => url()->previous()]);
        return view('auth.register');
    }

    // Handle registration
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'is_admin'   => false,
        ]);

        Auth::login($user);

        return redirect()
            ->intended(route('home'))
            ->with('success', 'Account created successfully.');
    }
}