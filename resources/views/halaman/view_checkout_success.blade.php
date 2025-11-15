@extends('layout.pelanggan')

@section('content')
    <div class="text-center mt-20">
        <h2 class="text-4xl font-bold text-green-600 mb-4">Pesanan Berhasil!</h2>
        <p class="text-stone-600 mb-6">Terima kasih sudah memesan di Kafe Memori. Pesananmu sedang diproses.</p>
        <a href="/"
           class="bg-amber-600 text-white px-6 py-3 rounded-lg hover:bg-amber-700 transition">
            Kembali ke Menu
        </a>
    </div>
@endsection