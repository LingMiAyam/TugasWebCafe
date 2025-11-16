@extends('layout.pelanggan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout Pesanan</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4">
                        @php $total = 0; @endphp
                        @forelse($cart as $id => $item)
                            @php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; @endphp
                            <div class="flex justify-between items-start border-b pb-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item['nama_menu'] }}</p>
                                    <p class="text-sm text-gray-600">{{ $item['qty'] }} x Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                            </div>
                        @empty
                            <p class="text-gray-600">Keranjang kosong</p>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t-2 flex justify-between items-center">
                        <p class="text-lg font-bold text-gray-800">Total:</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Form Checkout -->
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('cart.processCheckout') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-gray-800 font-bold mb-2">
                                <span class="text-red-500">*</span> Nomor Meja
                            </label>
                            <input 
                                type="number" 
                                name="nomor_meja" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:outline-none @error('nomor_meja') border-red-500 @enderror"
                                placeholder="Masukkan nomor meja (1-999)"
                                min="1"
                                max="999"
                                required
                                value="{{ old('nomor_meja') }}"
                            >
                            @error('nomor_meja')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-4">
                            <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg text-center transition">
                                Kembali
                            </a>
                            <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition">
                                Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-blue-50 border-2 border-blue-400 rounded-lg p-6 sticky top-4">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"></path>
                        </svg>
                        Informasi
                    </h3>
                    <p class="text-sm text-gray-700 mb-4">
                        Masukkan nomor meja Anda. Waiter kami akan mengantarkan pesanan Anda ke meja yang telah Anda tentukan.
                    </p>
                    <div class="bg-white rounded p-3 text-sm text-gray-600">
                        <p class="font-semibold text-gray-800 mb-2">Tips:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Pastikan nomor meja sudah benar</li>
                            <li>Pesanan akan disiapkan sesuai urutan</li>
                            <li>Pesanan akan dikirim saat siap</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
