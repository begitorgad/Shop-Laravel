<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
    }

    // List orders for the authenticated user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->with('items.product')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // Show a single order (owned by the user)
    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    // Create order from session cart
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }
        DB::transaction(function () use ($cart) {
            $total = collect($cart)->sum(fn ($item) =>
                $item['unit_price'] * $item['quantity']
            );

            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
                'status'  => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price'=> $item['unit_price'],
                ]);

                // Decrease stock safely
                Product::where('id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);
            }
        });

        // Clear cart after successful order
        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully.');
    }
}