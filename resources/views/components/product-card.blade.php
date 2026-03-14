<div style="border:1px solid #ddd; border-radius:12px; padding:16px; margin-bottom:12px;">
    <div>
    @if($product->image)
        <img 
        src="{{ asset('storage/' . $product->image->path) }}" 
        alt="{{ $product->name }}" 
        style="
                max-width: 360px;
                max-height: 360px;
                width: auto;
                height: auto;
                object-fit: cover;
                border-radius: 8px;
                ">
    @endif
    <h3 style="margin:0 0 8px;">{{ $product->name }}</h3>

    <p style="margin:0 0 12px;">
        @if ($product->discount > 0)
            <span style="text-decoration: line-through; color:#888;">
                {{ $product->formatted_price }}
            </span>
            <span style="margin-left:8px; font-weight:bold;">
                {{ $product->formatted_discounted_price }}
            </span>
        @else
            {{ $product->formatted_price }}
        @endif
    </p>
    <p>
        @if ($product->tags->isNotEmpty())
            <div style="display:flex; gap:6px; margin-bottom:8px; flex-wrap:wrap;">
                @foreach ($product->tags as $tag)
                    <x-badge :color="$tag->color"> {{ $tag->name }} </x-badge>
                @endforeach
            </div>
        @endif
    </p>
    <a href="{{ route('categories.show', ['category' => $product->category->id]) }}" style="margin:0 0 12px;">{{ $product->category->name }}</a>
    </div>
    <div style="display:flex; gap:12px;">
        <a href="{{ route('products.show', ['product' => $product->id]) }}">
            View details
        </a>

        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
            Edit product
        </a>

        <form
            action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this product?');"
        >
            @csrf
            @method('DELETE')

            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">
                Delete
            </button>
        </form>
        <form action="{{ route('cart.store') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit">Add to cart</button>
        </form>
    </div>
</div>