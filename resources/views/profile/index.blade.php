@extends('layouts.app')

@section('title', 'Your profile')

@section('content')
WOW THIS IS YOUR AMAZING PROFILE {{  auth()->user()->first_name }}
<div style="margin-bottom:16px;">
    <img
        src="{{ auth()->user()->image
                ? asset('storage/' . auth()->user()->image->path)
                : asset('images/avatar-placeholder.png') }}"
        alt="Profile picture"
        style="width:150px; height:150px; object-fit:cover; border-radius:50%; border:1px solid #ccc;"
    >
</div>
<form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div style="margin-bottom:8px;">
        <input type="file" name="image" accept="image/*" required>
        @error('image')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Change image</button>
</form>
@endsection