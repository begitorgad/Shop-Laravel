@extends('layouts.app')

@section('title', 'Categories stats')

@section('content')

@forelse ($categories as $category)
    <div style="margin-bottom:16px;">
        <p>
            Category: <strong>{{ $category->name }}</strong>
            with {{ $category->products_count }} type of products
            for an average of {{ number_format((float) $category->products_avg_price, 2, ',', ' ') }}$
            on {{ $category->products_sum_stock }} total products
        </p>

        <div style="opacity:0.9; margin-left:12px;">
            <strong>All tags:</strong>
            @php $tags = $tagsPerCategory->get($category->id); @endphp

            @if ($tags && $tags->isNotEmpty())
                <ul>
                    @php
                        $colors = ['#3490dc', '#38c172', '#aba15a', '#e3342f', '#9561e2'];
                    @endphp

                    @foreach ($tags as $t)
                        <x-badge :color="$colors[$t->tag_id % count($colors)]">
                            {{ $t->tag_name }} ({{ $t->total }})
                        </x-badge>
                    @endforeach
                </ul>
            @else
                <p style="margin:4px 0;">No tags</p>
            @endif
        </div>
    </div>
@empty
    <p>No categories</p>
@endforelse

@endsection