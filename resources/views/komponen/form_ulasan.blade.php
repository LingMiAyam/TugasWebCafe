{{-- Form untuk menambah ulasan --}}
<div class="mt-8 bg-stone-50 p-6 rounded-lg">
    <h3 class="text-lg font-bold text-stone-800 mb-4">Tambah Ulasan</h3>
    
    <form action="{{ route('ulasan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Rating</label>
            <div class="flex gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="mr-1" required>
                        <span class="text-2xl text-stone-300 hover:text-amber-500">★</span>
                    </label>
                @endfor
            </div>
            @error('rating')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="komentar" class="block text-sm font-semibold mb-2">Komentar</label>
            <textarea name="komentar" id="komentar" rows="4"
                      class="w-full px-3 py-2 border border-stone-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                      placeholder="Bagikan pengalaman Anda tentang menu ini..." required></textarea>
            @error('komentar')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-amber-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-amber-700 transition">
            Kirim Ulasan
        </button>
    </form>
</div>
