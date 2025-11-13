@extends('layout.app')

@section('title', 'Tambah Menu Baru')

@section('content')
    <div class="bg-white shadow-xl rounded-lg p-8 max-w-2xl mx-auto">
        <form action="/menu/store" method="POST">
            @csrf
            <div class="mb-5">
                <label for="nama_menu" class="block text-stone-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" id="nama_menu" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: Kopi Susu Gula Aren" required>
            </div>

            <div class="mb-5">
                <label for="kategori" class="block text-stone-700 font-bold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: Kopi, Non-Kopi, Makanan" required>
            </div>

            <div class="mb-6">
                <label for="harga" class="block text-stone-700 font-bold mb-2">Harga (Rupiah)</label>
                <input type="number" name="harga" id="harga" 
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" 
                       placeholder="Contoh: 20000 (tanpa Rp atau titik)" required>
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