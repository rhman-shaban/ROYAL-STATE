<div id="wsus_pagination">
    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())

            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-chevron-double-left"></i></a>
            </li>
            @endif
            @foreach ($elements as $element)
                @if (count($element) < 2)

                @else
                    @foreach ($element as $key => $el)
                        @if ($key == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $key }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $el }}">{{ $key }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-double-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
</div>
