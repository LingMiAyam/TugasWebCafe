<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function showMenuPelanggan()
    {
        $data_menu = Menu::paginate(6); 
        $kategoriList = Menu::select('kategori')->distinct()->pluck('kategori');

        return view('halaman.view_pelanggan', [
            'data_menu' => $data_menu,
            'kategoriList' => $kategoriList,
        ]);
    }

    public function index()
    {
        $menus = Menu::all();
        return view('halaman.view_menu', compact('menus'));
    }

    public function tambah() {
        return view('halaman.view_menu_tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'harga'     => 'required|numeric|min:1',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:30720',
        ]);

        try {
            $menu = new Menu;
            $menu->nama_menu = $request->nama_menu;
            $menu->kategori  = $request->kategori;
            $menu->harga     = $request->harga;

            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('menu_fotos', 'public');
                $menu->foto = $path;
            }

            $menu->save();

            return redirect()->route('menu.index')->with('sukses', 'Menu baru berhasil ditambah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error menyimpan menu: ' . $e->getMessage());
        }
    }

    public function edit($id) {
        $menu = Menu::findOrFail($id);
        return view('halaman.view_menu_edit', compact('menu'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'harga'     => 'required|numeric|min:1',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:30720',
        ]);

        try {
            $menu = Menu::find($id);
            $menu->nama_menu = $request->nama_menu;
            $menu->kategori = $request->kategori;
            $menu->harga = $request->harga;

            if ($request->hasFile('foto')) {
                if ($menu->foto) {
                    Storage::delete('public/menu_fotos/' . $menu->foto);
                }

                $path = $request->file('foto')->store('menu_fotos', 'public');
                $menu->foto = $path;
            }

            $menu->save();
            return redirect('/menu')->with('sukses', 'Menu berhasil di-update!');
        } catch (\Exception $e) {
            return dd("Error Hantu Edit: " . $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $menu = Menu::find($id);

            if ($menu->foto) {
                Storage::delete('public/'.$menu->foto);
            }

            $menu->delete();
            return redirect('/menu')->with('sukses', 'Menu berhasil dihapus!');
        } catch (\Exception $e) {
            return dd("Error Hantu Hapus: " . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $q = $request->input('q');

        $data_menu = Menu::with('ulasan_menu')
            ->where('nama_menu', 'like', "%{$q}%")
            ->orWhere('kategori', 'like', "%{$q}%")
            ->paginate(6)
            ->appends(request()->query());

        $kategoriList = Menu::select('kategori')->distinct()->pluck('kategori');

        return view('halaman.view_pelanggan', [
            'data_menu' => $data_menu,
            'kategoriList' => $kategoriList,
        ]);
    }

    public function detail($id)
    {
        $menu = Menu::with('ulasan_menu')->findOrFail($id);
        return view('halaman.view_menu_detail', compact('menu'));
    }

    public function filterRating(Request $request)
    {
        $minRating = $request->input('min_rating', 0);
        $kategori = $request->input('kategori');
        $sort = $request->input('sort', 'rating_desc');

        $query = Menu::with('ulasan_menu')
            ->when($kategori, fn($q) => $q->where('kategori', $kategori));

        $data_menu = $query->paginate(6)->appends(request()->query());

        $data_menu->getCollection()->transform(function ($menu) {
            $menu->avg_rating = $menu->ulasan_menu->avg('rating') ?? 0;
            return $menu;
        });

        if ($sort === 'harga_asc') {
            $sorted = $data_menu->getCollection()->sortBy(fn($m) => $m->harga)->values();
        } elseif ($sort === 'harga_desc') {
            $sorted = $data_menu->getCollection()->sortByDesc(fn($m) => $m->harga)->values();
        } else {
            $sorted = $data_menu->getCollection()->sortByDesc(fn($m) => $m->avg_rating)->values();
        }

        $data_menu->setCollection($sorted);

        $kategoriList = Menu::select('kategori')->distinct()->pluck('kategori');

        return view('halaman.view_pelanggan', [
            'data_menu' => $data_menu,
            'kategoriList' => $kategoriList,
        ]);
    }

}
