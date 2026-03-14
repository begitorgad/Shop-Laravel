@extends('layouts.app')

@section('title', 'Order details')

@section('content')

<h1>Order #{{ request('n', $order->id) }} <small>(ID {{  $order->id }})</small></h1>

<p>
    Date: {{ $order->created_at->format('d/m/Y H:i') }}<br>
    Status: {{ ucfirst($order->status) }}<br>
    Total: {{ number_format($order->total, 2) }} €
</p>

<h2>Items</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Product</th>
            <th>Unit price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ number_format($item->unit_price, 2) }} €</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price * $item->quantity, 2) }} €</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top:16px;">
    <a href="{{ route('orders.index') }}">← Back to my orders</a>
</div>

@endsection