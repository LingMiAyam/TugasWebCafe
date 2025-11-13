<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir Cafe') - Sayangku</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Ini class-class Tailwind! --}}
<body class="bg-gray-100 text-gray-800">

    <div class="flex">
        {{-- Ini Sidebar --}}
        <div class="w-64 bg-gray-900 text-white min-h-screen p-5">
            <h2 class="font-bold text-2xl mb-5">Kafe Sayangku ❤️</h2>
            <nav>
                <a href="/" 
                   class="block py-2.5 px-4 rounded hover:bg-gray-700">
                   Home
                </a>
                <a href="/menu" {{-- Nanti kita bikin rute ini --}}
                   class="block py-2.5 px-4 rounded hover:bg-gray-700">
                   Manajemen Menu
                </a>
            </nav>
        </div>

        {{-- Ini Isi Halaman --}}
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-5">@yield('title')</h1>

            {{-- Ini untuk Notifikasi Sukses --}}
            @if (session('sukses'))
                <div class="bg-green-500 text-white p-4 rounded mb-5">
                    {{ session('sukses') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>