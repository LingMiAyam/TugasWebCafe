@extends('layout.app')

@section('title', 'Daftar Menu')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-amber-900">Daftar Menu</h2>
        <a href="{{ route('menu.tambah') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            + Tambah Menu
        </a>
    </div>

    {{-- Alert sukses / error --}}
    @if(session('sukses'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('sukses') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel daftar menu --}}
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-stone-200">
                <th class="px-4 py-2 text-left">Nama Menu</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Harga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td class="px-4 py-2">{{ $menu->nama_menu }}</td>
                    <td class="px-4 py-2">{{ $menu->kategori }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($menu->harga,0,',','.') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('menu.edit', $menu->id) }}" 
                           class="text-blue-600 hover:underline">Edit</a>
                        <a href="{{ route('menu.hapus', $menu->id) }}" 
                           class="text-red-600 hover:underline ml-2">Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-stone-500 py-4">
                        Belum ada menu ditambahkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection