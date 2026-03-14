@extends('layouts.app')

@section('title', 'Register')

@section('content')

<h1>Register</h1>
<br>
<form action="{{ route('register') }}" method="POST">
    @csrf

    <div style="margin-bottom:12px;">
        <label for="first_name">First name</label><br>
        <input
            type="text"
            id="first_name"
            name="first_name"
            value="{{ old('first_name') }}"
            required
        >
        @error('first_name')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:12px;">
        <label for="last_name">Last name</label><br>
        <input
            type="text"
            id="last_name"
            name="last_name"
            value="{{ old('last_name') }}"
            required
        >
        @error('last_name')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:12px;">
        <label for="email">Email</label><br>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        @error('email')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:12px;">
        <label for="password">Password</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
        <div style="font-size:0.9rem; opacity:0.8; margin-top:4px;">
            Must include 1 uppercase, 1 lowercase, 1 number, and 1 special character.
        </div>
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom:16px;">
        <label for="password_confirmation">Confirm password</label><br>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
        >
        @error('password_confirmation')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Create account</button>
</form>

<p style="margin-top:16px;">
    Already have an account?
    <a href="{{ route('login') }}">Login</a>
</p>

@endsection