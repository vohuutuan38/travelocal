@if ($paginator->hasPages())
    <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up"
        data-aos-duration="1500" data-aos-offset="50">

        {{-- Nút Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-left"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="far fa-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Các số trang --}}
        @foreach ($elements as $element)
            {{-- Dấu ... --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Link số trang --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }} <span class="sr-only">(current)</span></span>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Nút Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="far fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link"><i class="far fa-chevron-right"></i></span>
            </li>
        @endif
    </ul>
@endif
