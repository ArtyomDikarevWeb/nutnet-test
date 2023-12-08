{{--
    Для пагинатора использовал компонент, потому что в будущем пагинация может понадобиться для чего-нибудь ещё

    Так же, что очень удобно, компоненты имеют внутри себя валидацию, а это значит, что ничего лишнего случайно передать
    мы туда не сможем
--}}

@if($paginator->hasPages())

    <div class="container__paginator">
        <div class="paginator">
            @if (!$paginator->onFirstPage())

                @if(($paginator->currentPage() - 1) === 1)

                    <x-pagination-item-component :link="$paginator->url(1)" :pageNumber="1" />

                @elseif(($paginator->currentPage() - 1) === 2)

                    <x-pagination-item-component :link="$paginator->url(1)" :pageNumber="1" />
                    <x-pagination-item-component
                        :link="$paginator->previousPageUrl()"
                        :pageNumber="$paginator->currentPage() - 1"
                    />

                @else

                    <x-pagination-item-component :link="$paginator->url(1)" :pageNumber="1" />
                    <div>...</div>
                    <x-pagination-item-component
                        :link="$paginator->previousPageUrl()"
                        :pageNumber="$paginator->currentPage() - 1"
                    />

                @endif
            @endif

            <x-pagination-item-component
                :link="$paginator->url($paginator->currentPage())"
                :pageNumber="$paginator->currentPage()"
                :class="'paginator-item__page-number--active'"
            />

            @if(($paginator->lastPage() === 2) && ($paginator->currentPage() !== 2))

                <x-pagination-item-component :link="$paginator->nextPageUrl()" :pageNumber="$paginator->lastPage()" />

            @elseif($paginator->lastPage() >= 3 && $paginator->currentPage() < $paginator->lastPage())

                @if(($paginator->currentPage()) === ($paginator->lastPage() - 1))

                    <x-pagination-item-component
                        :link="$paginator->url($paginator->lastPage())"
                        :pageNumber="$paginator->lastPage()"
                    />

                @elseif(($paginator->currentPage() + 1) === ($paginator->lastPage() - 1))

                    <x-pagination-item-component
                        :link="$paginator->nextPageUrl()"
                        :pageNumber="$paginator->currentPage() + 1"
                    />
                    <x-pagination-item-component
                        :link="$paginator->url($paginator->lastPage())"
                        :pageNumber="$paginator->lastPage()"
                    />

                @else

                    <x-pagination-item-component
                        :link="$paginator->nextPageUrl()"
                        :pageNumber="$paginator->currentPage() + 1"
                    />
                    <div>...</div>
                    <x-pagination-item-component
                        :link="$paginator->url($paginator->lastPage())"
                        :pageNumber="$paginator->lastPage()"
                    />

                @endif

            @endif

        </div>
    </div>

@endif
