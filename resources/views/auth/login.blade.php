@extends('layouts.app')

@section('title', 'Login')

@section('content')

<h1>Login</h1>
<br>
<form action="{{ route('login') }}" method="POST">
    @csrf

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
        @error('password') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>
            <input type="checkbox" name="remember">
            Remember me
        </label>
    </div>

    <div>
        <p style="margin-top:16px;">
            Don't have an account?
            <a href="{{ route('register') }}">register</a>
        </p>
    </div>
    <button type="submit">Login</button>
</form>

@endsection