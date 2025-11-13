@extends('layout.app')

@section('title', 'Edit Menu')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="/menu/update/{{ $menu->id }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_menu" class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" 
                       class="w-full px-3 py-2 border rounded-lg" 
                       value="{{ $menu->nama_menu }}" required>
            </div>

            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" 
                       class="w-full px-3 py-2 border rounded-lg" 
                       value="{{ $menu->kategori }}" required>
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-gray-700 font-bold mb-2">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" 
                       class="w-full px-3 py-2 border rounded-lg" 
                       value="{{ $menu->harga }}" required>
            </div>

            <div class="flex items-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Perubahan
                </button>
                <a href="/menu" class="text-gray-600 ml-4">Batal</a>
            </div>
        </form>
    </div>
@endsection