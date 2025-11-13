@extends('layout.app')

@section('title', 'Manajemen Menu')

@section('content')

    {{-- Tombol Tambah --}}
    <a href="/menu/tambah" 
       class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-6 inline-block shadow-md transition-all">
        + Tambah Menu Baru
    </a>

    {{-- Tabel --}}
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-amber-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Menu</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-left">Harga</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($data_menu as $menu)
                <tr class="hover:bg-stone-50">
                    <td class="py-4 px-6">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6 font-medium">{{ $menu->nama_menu }}</td>
                    <td class="py-4 px-6">{{ $menu->kategori }}</td>
                    <td class="py-4 px-6">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="/menu/edit/{{ $menu->id }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-sm shadow transition-all">
                           Edit
                        </a>
                        <a href="/menu/hapus/{{ $menu->id }}" 
                           class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-sm shadow transition-all ml-2"
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
    <div class="mt-6">
        {{ $data_menu->links() }}
    </div>

@endsection