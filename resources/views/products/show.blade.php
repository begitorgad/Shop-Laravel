@extends('layouts.app')

@section('title', 'This specific product')

@section('content')
<x-product-card :product="$product" />
@endsection