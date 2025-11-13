<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{

    public function index()
    {
        $data_menu = Menu::paginate(5);

        return view('halaman.view_menu', ['data_menu' => $data_menu]); 
    }

    // TAMBAH (Halaman Terpisah)
    public function tambah()
    {
        // Nampilin form menu tambah
        return view('halaman.view_menu_tambah'); 
    }

    public function store(Request $request)
    {
        try {
            $menu = new Menu;
            $menu->nama_menu = $request->nama_menu;
            $menu->kategori = $request->kategori;
            $menu->harga = $request->harga;
            $menu->save();

            // Kirim notifikasi sukses ke menu utama
            return redirect('/menu')->with('sukses', 'Menu baru berhasil ditambah!');

        } catch (\Exception $e) {
            return dd("Error Hantu Tambah: " . $e->getMessage());
        }
    }

    // EDIT (Halaman Terpisah) 
    public function edit($id)
    {
        $menu = Menu::find($id);
        // Nampilin form edit sambil bawa data lama
        return view('halaman.view_menu_edit', ['menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        try {
            $menu = Menu::find($id);
            $menu->nama_menu = $request->nama_menu;
            $menu->kategori = $request->kategori;
            $menu->harga = $request->harga;
            $menu->save();

            return redirect('/menu')->with('sukses', 'Menu berhasil di-update!');

        } catch (\Exception $e) {
            return dd("Error Hantu Edit: " . $e->getMessage());
        }
    }

    // HAPUS 
    public function hapus($id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();
            return redirect('/menu')->with('sukses', 'Menu berhasil dihapus!');
        } catch (\Exception $e) {
            return dd("Error Hantu Hapus: " . $e->getMessage());
        }
    }
}