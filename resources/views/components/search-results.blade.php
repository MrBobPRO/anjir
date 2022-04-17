
@if($products && count($products))
    @foreach ($products as $product)
        <li>
            <a href="{{ route('products.show', $product->id) }}">
                <img class="search-results__image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
                <div class="search-results__info">
                    <h6>{{ $product->title }}</h6>
                    <p>{{ $product->final_price }} сом</p>
                </div>
            </a>
        </li>
    @endforeach
@else
    <p class="search-results__empty">По вашему запросу нечего не найдено !</p>
@endif
