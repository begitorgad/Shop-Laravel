@extends('layouts.app')

@section('title', 'All products')

@section('content')
    <h1>{{ count($products) }} active products</h1>
    <a href="{{  route("admin.products.create")}}" >Create product</a>
    <ul>
    @forelse ($products as $product)
        <li>
            <x-product-card :product="$product" />
        </li>
    @empty
        <li>No active products</li>
    @endforelse
    {{ $products->links() }}
    </ul>
    <br>
    <h2>{{ count($inactiveProducts) }} inactive products</h2>
    <ul style="opacity: 0.6;">
    @forelse ($inactiveProducts as $product)
        <li>
            <x-product-card :product="$product" />
        </li>
    @empty
        <li>No inactive products</li>
    @endforelse
    {{ $inactiveProducts->links() }}
    </ul>
@endsection