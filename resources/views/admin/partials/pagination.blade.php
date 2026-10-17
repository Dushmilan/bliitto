@if ($paginator->hasPages())
    <nav class="admin-pagination">
        @if ($paginator->onFirstPage())
            <span class="admin-page-disabled">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Previous</a>
        @endif

        <span class="admin-page-info">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Next</a>
        @else
            <span class="admin-page-disabled">Next</span>
        @endif
    </nav>
@endif
