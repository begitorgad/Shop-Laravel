@extends('layouts.app')

@section('title', 'Forgot password')

@section('content')
Enter your email: 
<form mehotd="POST" action="{{ route('password.email') }}">
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
</form>
@endsection