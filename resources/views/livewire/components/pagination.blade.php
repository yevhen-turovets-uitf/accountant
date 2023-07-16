@if ($elements->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Кнопка "Previous" --}}
            @if ($elements->currentPage() > 1)
                <li>
                    <a href="{{ $elements->previousPageUrl() }}" rel="prev" class="pagination-link">&lsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span class="pagination-link">&lsaquo;</span>
                </li>
            @endif

            {{-- Номера страниц --}}
            @foreach ($elements->getUrlRange(1, $elements->lastPage()) as $page => $url)
                @if ($page == $elements->currentPage())
                    <li class="active" aria-current="page">
                        <span class="pagination-link">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Кнопка "Next" --}}
            @if ($elements->hasMorePages())
                <li>
                    <a href="{{ $elements->nextPageUrl() }}" rel="next" class="pagination-link">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <span class="pagination-link">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
<style>
    .pagination {
        display: flex;
        list-style: none;
        justify-content: center;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ccc;
        color: #333;
    }

    .pagination .active a,
    .pagination .active span {
        background-color: #333;
        color: #fff;
    }

    .pagination .disabled span {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
    }
</style>
