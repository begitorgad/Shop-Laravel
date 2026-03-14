<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // READ: show cart
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(fn ($item) => $item['unit_price'] * $item['quantity']);

        return view('cart.index', compact('cart', 'total'));
    }

    // CREATE: add product to cart
    public function store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1'],
        ]);

        $qty = $data['quantity'] ?? 1;

        $product = Product::findOrFail($data['product_id']);

        $cart = session()->get('cart', []);

        // If already in cart, increment quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'unit_price' => (float) $product->price, // keep raw number in cart
                'quantity'   => $qty,
                'image_path' => $product->image?->path,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Added to cart.');
    }

    // UPDATE: change quantity of a cart item
    public function update(Request $request, int $productId)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return redirect()
                ->back()
                ->with('error', 'Item not found in cart.');
        }

        if ($data['quantity'] <1) {
            if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            }

            return redirect()
                ->back()
                ->with('success', 'Item removed.');
        }

        $cart[$productId]['quantity'] = $data['quantity'];

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Cart updated.');
    }

    // DELETE: remove one product from cart
    public function destroy(int $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()
            ->back()
            ->with('success', 'Item removed.');
    }

    // DELETE ALL: empty the cart
    public function clear()
    {
        //dd('WOWOW DOES IT HIT OR WHAT?');
        session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('success', 'Cart cleared.');
    }
}