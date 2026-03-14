@extends('layouts.app')

@section('title', 'Your cart')

@section('content')
@if (!empty($cart))
    <h1>{{ count(value: $cart) }} products in your cart</h1>
    <ul>
    @foreach ($cart as $item)
        <li>
            <x-cart-item :item="$item" />
        </li>
    @endforeach
    </ul>
    <div style="display:flex; gap:12px;">
    <a>For a total of {{ $total }}$</a>
    <form method="POST" action="{{ route('cart.clear') }}">
    @csrf
    <button type="submit">Empty your cart</button>
    </form>
    <br>
    <!-- <a href="{{ route("cart.clear") }}">Clear cart but doesn't work</a> -->
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <button type="submit">Checkout</button>
    </form>
    </div>
@else
    <h1>Empty aaa cart</h1>
@endif
@endsection