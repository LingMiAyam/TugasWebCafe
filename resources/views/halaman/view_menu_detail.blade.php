@extends('layout.pelanggan')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden mt-8">
    {{-- Gambar --}}
    @if ($menu->foto)
        <img src="{{ asset('storage/'.$menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full h-64 object-cover">
    @else
        <div class="h-64 bg-stone-200 flex items-center justify-center">
            <span class="text-stone-400">Belum ada foto</span>
        </div>
    @endif

    <div class="p-6">
        <h2 class="text-3xl font-bold text-amber-800">{{ $menu->nama_menu }}</h2>
        <p class="text-stone-600 mt-1">{{ $menu->kategori }}</p>
        <p class="text-2xl text-green-600 font-bold mt-4">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

        {{-- Rata-rata rating --}}
        @php
            $avgRating = $menu->ulasan_menu->avg('rating');
            $rounded = round($avgRating);
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

        {{-- Tombol Tambah ke Pesanan --}}
        <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="mt-6">
            @csrf
            <button type="submit"
                class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-green-700 transition-all">
                + Tambah ke Pesanan
            </button>
        </form>

        {{-- Form Ulasan --}}
        @include('komponen.form_ulasan', ['menu' => $menu])

        {{-- Daftar Ulasan --}}
        <h3 class="text-xl font-bold text-stone-800 mt-10 mb-4">Ulasan Pelanggan</h3>
            @forelse ($menu->ulasan_menu as $ulasan)
                <div class="border rounded-lg p-4 mb-4 bg-stone-50">
                    {{-- Rating bintang --}}
                    <div class="flex items-center gap-2 mb-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $ulasan->rating ? 'text-amber-500' : 'text-stone-300' }}">★</span>
                        @endfor
                    </div>

                    {{-- Komentar --}}
                    <p class="text-stone-700">{{ $ulasan->komentar }}</p>

                    {{-- Info user --}}
                    <p class="text-sm text-stone-500 mt-2">
                        Ditulis oleh <span class="font-semibold">{{ $ulasan->user->name ?? 'Pengunjung' }}</span>
                        pada {{ $ulasan->created_at->format('d M Y') }}
                    </p>

                    @if (auth()->check() && $ulasan->user_id === auth()->id())
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('ulasan.edit', $ulasan->id) }}"
                            class="text-sm text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('ulasan.delete', $ulasan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus ulasan ini?')"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-stone-500 italic">Belum ada ulasan untuk menu ini.</p>
            @endforelse
    </div>
</div>
@endsection