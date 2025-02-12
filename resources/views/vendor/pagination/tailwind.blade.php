@if ($paginator->hasPages())
    <div class="flex items-center justify-between flex-wrap gap10">
        <div class="text-tiny">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
        </div>
        <ul class="wg-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span><i class="icon-chevron-left"></i></span></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"><i class="icon-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"><i class="icon-chevron-right"></i></a>
                </li>
            @else
                <li class="disabled"><span><i class="icon-chevron-right"></i></span></li>
            @endif
        </ul>
    </div>
@endif