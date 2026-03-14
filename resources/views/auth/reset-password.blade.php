@extends('layouts.app')

@section('title', 'Forgot password')

@section('content')

<form mehotd="POST" action="{{ route('password.update') }}">
    Enter your email: 
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

    <button type="submit">Change password</button>
</form>
@endsection