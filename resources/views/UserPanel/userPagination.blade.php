@if ($orderList->hasPages())
    <ul class="pagination justify-content-start float-end">
        @if ($orderList->onFirstPage())
            <li class="page-item disabled"><a class="page-link" ><i class="fi-rs-angle-double-small-left"></i></a></li>
        @else
            <li class="page-item page-item"><a class="page-link" href="{{ $orderList->previousPageUrl() }}" rel="prev"><i class="fi-rs-angle-double-small-left"></i></a></li>
        @endif

        @if($orderList->currentPage() > 3)
            <li class="page-item hidden-xs"><a class="page-link" href="{{ $orderList->url(1) }}">1</a></li>
        @endif
        @if($orderList->currentPage() > 4)
            <li><span>...</span></li>
        @endif
        @foreach(range(1, $orderList->lastPage()) as $i)
            @if($i >= $orderList->currentPage() - 2 && $i <= $orderList->currentPage() + 2)
                @if ($i == $orderList->currentPage())
                    <li class="page-item active"><a class="page-link" >{{ $i }}</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $orderList->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($orderList->currentPage() < $orderList->lastPage() - 3)
        <li class="page-item"><span>...</span></li>
        @endif
        @if($orderList->currentPage() < $orderList->lastPage() - 2)
            <li class="page-item hidden-xs"><a class="page-link" href="{{ $orderList->url($orderList->lastPage()) }}">{{ $orderList->lastPage() }}</a></li>
        @endif

        @if ($orderList->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $orderList->nextPageUrl() }}" rel="next"><i class="fi-rs-angle-double-small-right"></i></a></li>
        @else
            <li class="disabled"><a class="page-link" ><i class="fi-rs-angle-double-small-right"></i></a></li>
        @endif
    </ul>
@endif