@if ($paginator->hasPages())
    <div class="btn-group mr-2" role="group" aria-label="Pagination Nidoo Business Solutions">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button type="button" class="btn btn-secondary disabled">&laquo;</button>
        @else
            <button type="button" class="btn btn-secondary"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <button type="button" class="btn btn-secondary disabled">{{ $element }}</button>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button type="button" class="btn btn-info">{{ $page }}</button>
                    @else
                        <button type="button" class="btn btn-secondary"><a href="{{ $url }}">{{ $page }}</a></button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button type="button" class="btn btn-secondary"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></button>
        @else
            <button type="button" class="btn btn-secondary disabled">&raquo;</button>
        @endif
    </div>
@endif
