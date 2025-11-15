@extends('layout.pelanggan')

@section('content')
    <h2 class="text-4xl font-bold text-amber-900 mb-8 text-center">Menu Kami</h2>
    <form action="{{ route('menu.search') }}" method="GET" class="max-w-md mx-auto mb-8 flex">
        <input type="text" name="q" placeholder="Cari menu..."
           class="flex-grow px-4 py-2 border border-stone-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
        <button type="submit"
            class="bg-amber-600 text-white px-4 py-2 rounded-r-lg hover:bg-amber-700 transition">
                Cari
        </button>
    </form>

    @if(request('q'))
        <p class="text-center text-stone-600 mb-4">
            Hasil pencarian untuk: <span class="font-semibold">{{ request('q') }}</span>
        </p>
    @endif

    <form action="{{ route('menu.filterRating') }}" method="GET" 
        class="flex flex-wrap gap-4 items-end mb-6">

        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-semibold mb-1">Kategori</label>
            <select name="kategori" class="w-full border rounded-lg px-3 py-2">
                <option value="">Semua</option>
                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                        {{ $kat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-semibold mb-1">Rating</label>
            <select name="min_rating" class="w-full border rounded-lg px-3 py-2">
                <option value="0">Semua</option>
                <option value="3">3+</option>
                <option value="4">4+</option>
                <option value="4.5">4.5+</option>
            </select>
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-semibold mb-1">Urutkan</label>
            <select name="sort" class="w-full border rounded-lg px-3 py-2">
                <option value="rating_desc">Rating</option>
                <option value="harga_asc">Murah</option>
                <option value="harga_desc">Mahal</option>
            </select>
        </div>

        <button type="submit"
            class="bg-amber-600 text-white font-bold px-4 py-2 rounded-lg hover:bg-amber-700 transition">
            Filter
        </button>
    </form>

    @if(request('min_rating') || request('kategori'))
    <div class="text-center mb-6">
        <a href="/"
           class="inline-block bg-stone-200 text-stone-700 px-4 py-2 rounded-full font-semibold hover:bg-stone-300 transition">
            Reset Filter
        </a>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($data_menu as $menu)
        <div class="bg-white rounded-lg shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300">
            {{-- Gambar --}}
            @if ($menu->foto)
                <img src="{{ asset('storage/'.$menu->foto) }}" 
                    alt="{{ $menu->nama_menu }}" 
                    class="h-48 w-full object-cover">
            @else
                <div class="h-48 bg-stone-200 flex items-center justify-center">
                    <span class="text-stone-400"> (Belum ada foto) </span>
                </div>
            @endif

            <div class="p-6">
                <h3 class="text-2xl font-bold text-amber-800">{{ $menu->nama_menu }}</h3>
                <span class="inline-block bg-stone-200 text-stone-700 px-3 py-1 rounded-full text-sm font-semibold mt-2">
                    {{ $menu->kategori }}
                </span>
                    @php
                        $avgRating = $menu->ulasan_menu->avg('rating');
                        $rounded = round($avgRating ?? 0);
                    @endphp
                    <div class="flex items-center mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $rounded ? 'text-amber-500' : 'text-stone-300' }}">★</span>
                        @endfor
                        @if ($avgRating)
                            <span class="ml-2 text-sm text-stone-600">({{ number_format($avgRating, 1) }})</span>
                        @else
                            <span class="ml-2 text-sm text-stone-400 italic">Belum ada ulasan</span>
                        @endif
                    </div>
                <p class="text-3xl font-bold text-green-600 mt-4">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </p>
                @php
                    $totalUlasan = $menu->ulasan_menu->count();
                @endphp

                <p class="text-sm text-stone-500 mt-2">
                    {{ $totalUlasan }} ulasan pelanggan
                </p>

                {{--Tombol Tambah Pesanan --}}
                <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg mt-6 shadow-md hover:bg-green-700 transition-all">
                        + Tambah ke Pesanan
                    </button>
                </form>
                <a href="{{ route('menu.detail', $menu->id) }}"
                    class="block text-center mt-4 text-amber-700 font-semibold hover:underline">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach

    </div>
    <div class="mt-8">
        {{ $data_menu->links('pagination::custom') }}
</div>

@endsection