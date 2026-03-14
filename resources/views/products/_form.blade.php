@csrf

<div>
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $product->category_id ?? null) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="name">Name</label>
    <input
        type="text"
        name="name"
        id="name"
        value="{{ old('name', $product->name ?? '') }}"
        required
    >
    @error('name')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="description">Description</label>
    <textarea name="description" id="description">{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div>
    <label for="price">Price</label>
    <input
        type="number"
        name="price"
        id="price"
        step="0.01"
        min="0"
        value="{{ old('price', $product->price ?? '') }}"
        required
    >
    @error('price')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="stock">Stock</label>
    <input
        type="number"
        name="stock"
        id="stock"
        min="0"
        value="{{ old('stock', $product->stock ?? 0) }}"
        required
    >
    @error('stock')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="discount">Discount (%)</label>
    <input
        type="number"
        name="discount"
        id="discount"
        min="0"
        max="100"
        value="{{ old('discount', $product->discount ?? 0) }}"
    >
    @error('discount')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label>
        <input
            type="checkbox"
            name="active"
            value="1"
            @checked(old('active', $product->active ?? true))
        >
        Active
    </label>
    @error('active')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="image">Image</label>

    @if (!empty($product) && $product->image)
        <div style="margin: 8px 0;">
            <img
                src="{{ asset('storage/' . $product->image->path) }}"
                alt="{{ $product->name }}"
                style="max-width: 180px; border-radius: 8px; border:1px solid #ddd;"
            >
        </div>
    @endif

    <input type="file" name="image" id="image" accept="image/*">
    @error('image')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<div>
    <label>Tags</label>
    <div style="display:flex; gap:12px; flex-wrap:wrap;">
        @foreach ($tags as $tag)
            <label style="display:flex; align-items:center; gap:6px;">
                <input
                    type="checkbox"
                    name="tags[]"
                    value="{{ $tag->id }}"
                    @checked(
                        in_array(
                            $tag->id,
                            old('tags', isset($product) ? $product->tags->pluck('id')->all() : [])
                        )
                    )
                >
                {{ $tag->name }}
            </label>
        @endforeach
    </div>
    @error('tags')
        <div style="color:red;">{{ $message }}</div>
    @enderror

    @error('tags.*')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

<button type="submit">
    {{ isset($product) ? 'Update product' : 'Create product' }}
</button>