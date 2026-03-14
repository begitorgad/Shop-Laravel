@extends('layouts.app')

@section('content')
<h1>Edit product</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('products._form', ['product' => $product])
</form>
@endsection