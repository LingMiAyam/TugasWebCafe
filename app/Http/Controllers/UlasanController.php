<?php

namespace App\Http\Controllers;

use App\Models\UlasanMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id() ?? null; // Allow null user for guest comments

        // Simpan ulasan baru
        UlasanMenu::create([
            'menu_id' => $request->menu_id,
            'user_id' => $userId,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('sukses', 'Terima kasih atas ulasannya!');
    }

    public function edit($id)
    {
        $ulasan = UlasanMenu::findOrFail($id);

        if (auth()->check() && $ulasan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('halaman.edit_ulasan', compact('ulasan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        $ulasan = UlasanMenu::findOrFail($id);

        if (auth()->check() && $ulasan->user_id !== auth()->id()) {
            abort(403);
        }

        $ulasan->update([
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('menu.detail', $ulasan->menu_id)->with('sukses', 'Ulasan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ulasan = UlasanMenu::findOrFail($id);

        if (auth()->check() && $ulasan->user_id !== auth()->id()) {
            abort(403);
        }

        $ulasan->delete();

        return back()->with('sukses', 'Ulasan berhasil dihapus.');
    }
}