@extends('layout.pelanggan')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-xl">
    <h2 class="text-2xl font-bold text-amber-800 mb-4">Edit Ulasan</h2>

    <form action="{{ route('ulasan.update', $ulasan->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Rating --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Rating:</label>
            <select name="rating" class="w-full border rounded-lg px-4 py-2">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $ulasan->rating == $i ? 'selected' : '' }}>
                        {{ $i }} bintang
                    </option>
                @endfor
            </select>
        </div>

        {{-- Komentar --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Komentar:</label>
            <textarea name="komentar" rows="4"
                      class="w-full border rounded-lg px-4 py-2">{{ $ulasan->komentar }}</textarea>
        </div>

        <button type="submit"
                class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection