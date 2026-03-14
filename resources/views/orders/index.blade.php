@extends('layouts.app')

@section('title', 'My orders')

@section('content')

<h1>My orders</h1>

@if ($orders->isEmpty())
    <p>You have no orders yet.</p>
@else
    <ul style="list-style:none; padding:0;">
        @foreach ($orders as $order)
            <li style="border:1px solid #ddd; padding:12px; margin-bottom:12px;">
                <strong>Order #{{ $loop->iteration }}</strong>
                <small>(ID {{ $order->id }})</small>
                <br>
                Date: {{ $order->created_at->format('d/m/Y') }}<br>
                Status: {{ ucfirst($order->status) }}<br>
                Total: {{ number_format($order->total, 2) }}$

                <div style="margin-top:8px;">
                    <a href="{{ route('orders.show', ['order' =>$order, 'n' => $loop->iteration]) }}">
                        View details
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@endif

@endsection