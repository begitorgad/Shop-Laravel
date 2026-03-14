
@props([
    'type' => 'primary',
    'href' => null
])

@php
    $classes = [
        'primary' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
    ][$type];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "px-4 py-2 rounded $classes"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "px-4 py-2 rounded $classes"]) }}>
        {{ $slot }}
    </button>
@endif


<x-button type="primary">Add to cart</x-button>
<x-button type="danger" href="/products/1/delete">Delete</x-button>