@extends('layouts.app')

@section('title', 'Home - ShopLaravel')

@section('content')
    @auth
        <span>We have your familly {{ auth()->user()->first_name }}</span>
    @endauth

    @guest
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('login') }}">Login</a>
    @endguest
@endsection