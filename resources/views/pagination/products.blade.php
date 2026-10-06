@if ($paginator->hasPages())
    <nav class="products-pagination" role="navigation" aria-label="Pagination">
        <p class="results-text">Showing {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} products</p>
        <div class="pagination-links">
            @if ($paginator->onFirstPage())
                <span class="disabled" aria-disabled="true" aria-label="Previous page">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">&laquo;</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="disabled" aria-disabled="true">{{ $element }}</span>
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
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">&raquo;</a>
            @else
                <span class="disabled" aria-disabled="true" aria-label="Next page">&raquo;</span>
            @endif
        </div>
    </nav>
@endif
