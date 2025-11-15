<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kafe Memori ✨</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Class-class Tailwind --}}
<body class="bg-stone-100 text-stone-800">

    {{-- Header Kafe --}}
    <header class="bg-amber-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto p-5 flex justify-between items-center">
            <h1 class="font-bold text-3xl">Kafe Memori ✨</h1>
            <nav>
                <a href="/" class="hover:text-stone-200">Menu</a>
                <a href="{{ route('cart.index') }}" class="ml-4 hover:text-stone-200">🛒 Keranjang</a>
                {{-- Link ke CRUD --}}
                <a href="/menu" class="ml-4 bg-white text-amber-800 font-bold py-2 px-4 rounded-lg shadow hover:bg-stone-200 transition-all">
                    Login Kasir
                </a>
            </nav>
        </div>
    </header>

    {{-- Ini Isi Halaman (Menu Pelanggan) --}}
    <main class="container mx-auto p-5 mt-5">
        {{-- Alert Sukses --}}
        @if (session('sukses'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                {{ session('sukses') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>