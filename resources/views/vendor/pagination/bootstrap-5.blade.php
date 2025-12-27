<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item previous disabled">
            <a href="#" class="page-link" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="ki-duotone ki-arrow-left fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </li>
    @else
        <li class="page-item previous">
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="ki-duotone ki-arrow-left fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @if ($paginator->hasPages())
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    @else
        {{-- Single page --}}
        <li class="page-item active" aria-current="page">
            <span class="page-link">1</span>
        </li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item next">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next" aria-label="@lang('pagination.next')">
                <i class="ki-duotone ki-arrow-right fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </li>
    @else
        <li class="page-item next disabled">
            <a href="#" class="page-link" aria-disabled="true" aria-label="@lang('pagination.next')">
                <i class="ki-duotone ki-arrow-right fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </a>
        </li>
    @endif
</ul>
