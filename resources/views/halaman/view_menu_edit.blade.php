@extends('layout.app')

@section('title', 'Edit Menu')

@section('content')
    <div class="bg-white shadow-xl rounded-lg p-8 max-w-2xl mx-auto">
        <form action="/menu/update/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="nama_menu" class="block text-stone-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       value="{{ $menu->nama_menu }}" required>
            </div>

            <div class="mb-5">
                <label for="kategori" class="block text-stone-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       value="{{ $menu->kategori }}" required>
            </div>

            <div class="mb-6">
                <label for="harga" class="block text-stone-700 font-bold mb-2">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       value="{{ $menu->harga }}" required>
            </div>

            <div class="mb-6">
                <label for="foto" class="block text-stone-700 font-bold mb-2">Upload Foto Baru (Opsional)</label>
                <input type="file" name="foto" id="foto" 
                        class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                <p class="text-stone-500 text-sm mt-1">Format: JPG, JPEG, PNG | Ukuran maksimal: 30MB</p>

            @if ($menu->foto)
                <div class="mt-4">
                    <p>Foto Sekarang:</p>
                        <img src="{{ asset('storage/'.$menu->foto) }}" alt="{{ $menu->nama_menu }}">
                        </div>
                    @endif
                </div>

            <div class="flex items-center">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all">
                    Simpan Perubahan
                </button>
                <a href="/menu" class="text-gray-600 hover:text-gray-800 ml-4 transition-all">Batal</a>
            </div>
        </form>
    </div>
@endsection