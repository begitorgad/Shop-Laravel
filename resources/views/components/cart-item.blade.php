@props(['item'])

<div style="display:flex; gap:16px; align-items:center; border-bottom:1px solid #eee; padding:12px 0;">
    {{-- Image --}}
    @if ($item['image_path'])
        <img
            src="{{ asset('storage/'.$item['image_path']) }}"
            alt="{{ $item['name'] }}"
            style="width:80px; height:80px; object-fit:cover; border-radius:8px;"
        >
    @endif

    {{-- Info --}}
    <div style="flex:1;">
        <strong>{{ $item['name'] }}</strong><br>
        Unit price: {{ number_format($item['unit_price'], 2) }}$
    </div>

    {{-- Quantity update --}}
    <form action="{{ route('cart.update', $item['product_id']) }}" method="POST">
        @csrf
        @method('PATCH')

        <input
            type="number"
            name="quantity"
            value="{{ $item['quantity'] }}"
            min="1"
            style="width:60px;"
        >

        <button type="submit">Update</button>
    </form>

    {{-- Subtotal --}}
    <div>
        <strong>
            {{ number_format($item['unit_price'] * $item['quantity'], 2) }}$
        </strong>
    </div>

    {{-- Remove --}}
    <form action="{{ route('cart.destroy', $item['product_id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button style="color:red;">Remove</button>
    </form>
</div>