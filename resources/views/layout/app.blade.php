<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir Cafe') - Kafe Memori</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Ini class-class Tailwind BARU! --}}
<body class="bg-stone-100 text-stone-800">

    <div class="flex">
        {{-- Ini Sidebar --}}
        <div class="w-64 bg-amber-800 text-white min-h-screen p-5 shadow-lg">
            <h2 class="font-bold text-3xl mb-6">Kafe Memori</h2>
            <nav>
                <a href="/" 
                   class="block py-3 px-4 rounded-lg hover:bg-amber-700 transition-all">
                   <i class="fas fa-home mr-2"></i> Home
                </a>
                <a href="/menu"
                   class="block py-3 px-4 rounded-lg hover:bg-amber-700 transition-all">
                   <i class="fas fa-book-open mr-2"></i> Manajemen Menu
                </a>
            </nav>
        </div>

        {{-- Ini Isi Halaman --}}
        <div class="flex-1 p-10">
            <h1 class="text-4xl font-bold text-amber-900 mb-6">@yield('title')</h1>

            {{-- Ini untuk Notifikasi Sukses --}}
            @if (session('sukses'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
                    {{ session('sukses') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    {{-- Kita panggil Font Awesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>