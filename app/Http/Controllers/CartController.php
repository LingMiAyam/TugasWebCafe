<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {

        $menu = Menu::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'nama_menu' => $menu->nama_menu,
                'harga'     => $menu->harga,
                'qty'       => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('sukses', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
    $cart = session()->get('cart', []);

    return view('halaman.view_cart', compact('cart'));
    }

    public function remove($id)
    {
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('sukses', 'Item berhasil dihapus dari keranjang!');
    }

    public function update(Request $request, $id)
    {
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $qty = (int) $request->input('qty', 1);

        if ($qty > 0) {
            $cart[$id]['qty'] = $qty;
        } else {

            unset($cart[$id]);
        }

        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('sukses', 'Keranjang berhasil diperbarui!');
    }

    public function clear()
    {
    session()->forget('cart');
    return redirect()->route('cart.index')->with('sukses', 'Keranjang berhasil dikosongkan!');
    }

    public function checkout()
    {
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
    }

    return view('halaman.view_checkout_form', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|integer|min:1|max:999',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        // Simpan order ke database
        Order::create([
            'nomor_meja' => $request->nomor_meja,
            'items' => $cart,
            'total_harga' => $total,
            'status' => 'pending',
        ]);

        session()->forget('cart');

        return view('halaman.view_checkout_success', [
            'nomor_meja' => $request->nomor_meja,
            'total' => $total,
        ]);
    }
}