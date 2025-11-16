@extends('layout.pelanggan')

@section('content')
    <h2 class="text-3xl font-bold text-amber-900 mb-6 text-center">Keranjang Pesanan</h2>

    @if(empty($cart))
        <p class="text-center text-stone-500">Keranjang masih kosong.</p>
    @else
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-stone-200">
                    <th class="px-4 py-2 text-left">Menu</th>
                    <th class="px-4 py-2">Qty</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; @endphp
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $item['nama_menu'] }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-center gap-2">
                                @csrf
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                    class="w-16 border rounded px-2 py-1 text-center">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 text-right">Rp {{ number_format($item['harga'],0,',','.') }}</td>
                        <td class="px-4 py-2 text-right">Rp {{ number_format($subtotal,0,',','.') }}</td>
                        <td class="px-4 py-2 text-center">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(!empty($cart))
            <div class="mt-8 bg-stone-100 p-6 rounded-lg">
                <div class="text-right mb-6">
                    <p class="text-2xl font-bold text-green-600">
                        Total: Rp {{ number_format($total,0,',','.') }}
                    </p>
                </div>
                
                <div class="flex justify-between gap-4">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-800 transition"
                            onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                            Kosongkan Keranjang
                        </button>
                    </form>

                    <a href="{{ route('cart.checkout') }}"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-bold inline-block">
                        Checkout
                    </a>
                </div>
            </div>
        @endif
    @endif
@endsection