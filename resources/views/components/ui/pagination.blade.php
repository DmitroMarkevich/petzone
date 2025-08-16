@if ($paginator->hasPages())
    <nav class="pagination-nav">
        @php
            $current = $paginator->currentPage();
            $last = $paginator->lastPage();
            $delta = 1;

            $start = max(1, $current - $delta);
            $end = min($last, $current + $delta);

            if ($end - $start < $delta * 2) {
                if ($start == 1) {
                    $end = min($last, $start + $delta * 2);
                } else {
                    $start = max(1, $end - $delta * 2);
                }
            }
        @endphp

        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled"><span>‹</span></li>
            @else
                <li class="pagination-item"><a href="{{ $paginator->previousPageUrl() }}">‹</a></li>
            @endif

            @if ($start > 1)
                <li class="pagination-item"><a href="{{ $paginator->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="pagination-dots">…</li>
                @endif
            @endif

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $current)
                    <li class="pagination-item active"><span>{{ $page }}</span></li>
                @else
                    <li class="pagination-item"><a href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endfor

            @if ($end < $last)
                @if ($end < $last - 1)
                    <li class="pagination-dots">…</li>
                @endif
                <li class="pagination-item"><a href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="pagination-item"><a href="{{ $paginator->nextPageUrl() }}">›</a></li>
            @else
                <li class="pagination-item disabled"><span>›</span></li>
            @endif
        </ul>
    </nav>
@endif
