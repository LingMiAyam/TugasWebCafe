@extends('layout.app')

@section('title', 'Manajemen Menu')

@section('content')

    {{-- Tombol Tambah (Tailwind) --}}
    <a href="/menu/tambah" 
       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5 inline-block">
        + Tambah Menu Baru
    </a>

    {{-- Tabel (Tailwind) --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-5 text-left">No</th>
                    <th class="py-3 px-5 text-left">Nama Menu</th>
                    <th class="py-3 px-5 text-left">Kategori</th>
                    <th class="py-3 px-5 text-left">Harga</th>
                    <th class="py-3 px-5 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($data_menu as $menu)
                <tr>
                    <td class="py-4 px-5">{{ $loop->iteration }}</td>
                    <td class="py-4 px-5">{{ $menu->nama_menu }}</td>
                    <td class="py-4 px-5">{{ $menu->kategori }}</td>
                    <td class="py-4 px-5">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="py-4 px-5">
                        <a href="/menu/edit/{{ $menu->id }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm">
                           Edit
                        </a>
                        <a href="/menu/hapus/{{ $menu->id }}" 
                           class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                           onclick="return confirm('Yakin mau hapus menu {{ $menu->nama_menu }}?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination (Tailwind) --}}
    <div class="mt-5">
        {{ $data_menu->links() }}
    </div>

@endsection