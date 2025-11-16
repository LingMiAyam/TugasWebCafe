@extends('layout.pelanggan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="mb-6">
            <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Berhasil!</h1>

        @if(isset($nomor_meja))
        <div class="bg-blue-50 border-2 border-blue-400 rounded-lg p-6 mb-6">
            <p class="text-gray-600 text-sm font-semibold mb-2">NOMOR MEJA</p>
            <p class="text-4xl font-bold text-blue-600">{{ $nomor_meja }}</p>
            <p class="text-gray-600 text-sm mt-3">Pesanan akan diantar ke meja ini</p>
        </div>
        @endif

        @if(isset($total))
        <div class="mb-6">
            <p class="text-gray-600 text-sm mb-1">Total Pembayaran</p>
            <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($total, 0, ',', '.') }}</p>
        </div>
        @endif

        <p class="text-gray-600 mb-8">
            Pesanan Anda telah diterima. Silakan menunggu, pesanan akan segera disiapkan dan diantar ke meja Anda.
        </p>

        <a href="/" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition">
            Kembali ke Menu
        </a>
    </div>
</div>
@endsection