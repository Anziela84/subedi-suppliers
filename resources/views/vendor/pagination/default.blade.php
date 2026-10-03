@if ($paginator->hasPages())
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <p class="results-text text-sm">
            Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} results
        </p>
        <nav class="pagination-links" role="navigation" aria-label="Pagination">
            @if ($paginator->onFirstPage())
                <span class="disabled" aria-disabled="true">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            @else
                <span class="disabled" aria-disabled="true">&raquo;</span>
            @endif
        </nav>
    </div>
@endif
