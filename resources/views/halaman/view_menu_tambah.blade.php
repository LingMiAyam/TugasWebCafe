@extends('layout.app')

@section('title', 'Tambah Menu Baru')

@section('content')
    <div class="bg-white shadow-xl rounded-lg p-8 max-w-2xl mx-auto">
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <h3 class="font-bold mb-2">Terjadi Error!</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="nama_menu" class="block text-stone-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" 
                       class="w-full px-4 py-3 border @error('nama_menu') border-red-500 @else border-stone-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: Kopi Susu Gula Aren" 
                       value="{{ old('nama_menu') }}" required>
                @error('nama_menu')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="kategori" class="block text-stone-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" 
                       class="w-full px-4 py-3 border @error('kategori') border-red-500 @else border-stone-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: Kopi, Non-Kopi, Makanan" 
                       value="{{ old('kategori') }}" required>
                @error('kategori')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="harga" class="block text-stone-700 font-bold mb-2">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" 
                       class="w-full px-4 py-3 border @error('harga') border-red-500 @else border-stone-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: 20000 (tanpa Rp atau titik)" 
                       value="{{ old('harga') }}" required>
                @error('harga')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="foto" class="block text-stone-700 font-bold mb-2">Foto Menu</label>
                <input type="file" name="foto" id="foto" 
                        class="w-full px-4 py-3 border @error('foto') border-red-500 @else border-stone-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                <p class="text-stone-500 text-sm mt-1">Format: JPG, JPEG, PNG | Ukuran maksimal: 30MB (Opsional)</p>
                @error('foto')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all">
                    Simpan Menu
                </button>
                <a href="/menu" class="text-gray-600 hover:text-gray-800 ml-4 transition-all">Batal</a>
            </div>
        </form>
    </div>
@endsection