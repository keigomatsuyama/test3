@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <ul class="inline-flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="text-gray-500">&lt;</li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="text-gray-500">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="bg-gradient-to-r from-purple-300 to-pink-300 text-white rounded px-2 py-1">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}" class="px-2 py-1 text-gray-700">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
            @else
                <li class="text-gray-500">&gt;</li>
            @endif
        </ul>
    </nav>
@endif
