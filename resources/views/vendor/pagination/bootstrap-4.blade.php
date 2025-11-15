@if ($paginator->hasPages())
    <nav class="flex justify-center mt-6 space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-stone-200 text-stone-400 rounded-lg">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">←</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 text-stone-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-green-600 text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 bg-stone-200 text-stone-700 rounded-lg hover:bg-stone-300 transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">→</a>
        @else
            <span class="px-3 py-2 bg-stone-200 text-stone-400 rounded-lg">→</span>
        @endif
    </nav>
@endif