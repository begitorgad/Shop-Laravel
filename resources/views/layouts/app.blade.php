<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopLaravel')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4" style="display: flex; justify-content: space-between; align-items: center;">
        <nav class="container mx-auto">
            <a href="{{ route('home') }}" class="font-bold text-xl">ShopLaravel</a>
            <a href="{{ route('products.index') }}" class="ml-4">Products</a>
            <a href="{{ route('about') }}" class="ml-4">About</a>
        </nav>
        <nav style="margin-left:auto; display:flex; align-items:center;gap:8px;">
            <a href="{{ route('cart.index') }}">🛒<span class="header__cart-badge">{{ count(session()->get('cart', [])) }}</span></a>
            @auth
                <a href="{{ route('profile') }}">My profile</a>
                <img
                    src="{{ auth()->user()->image
                            ? asset('storage/' . auth()->user()->image->path)
                            : asset('images/avatar-placeholder.png') }}"
                    alt="Profile picture"
                    style="width:50px; height:50px; object-fit:cover; border-radius:50%; border:1px solid #ccc;"
                >
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Login</a>
            @endguest
        </nav>

    </header>
    
    <main class="container mx-auto py-8">
        {{-- Validation errors --}}
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Flash messages --}}
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} ShopLaravel - All rights reserved.
        </div>
    </footer>
</body>
</html> 