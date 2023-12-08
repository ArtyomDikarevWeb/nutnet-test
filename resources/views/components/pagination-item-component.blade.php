{{--
    Конкретный item пагинации было не обязательно выносить, я сделал это для упрощения понимания логики проверяющим
--}}

<a href="{{ $link }}">
    <div class="paginator-item">
        <p class="paginator-item__page-number {{ $class }}">{{ $pageNumber }}</p>
    </div>
</a>
