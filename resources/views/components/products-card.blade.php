@props(['product', 'productsInBasket' => session('basket') ? session('basket') : []])

<div class="product-card">
    <form action="javascript:void(0)" class="product-card__form">
        @csrf

        <a href="{{ route('products.show', $product->id) }}" class="product-card__appearance">
            @if ($product->discount)
                <span class="product-card__discount">-{{ $product->discount }}%</span>
            @endif
            <img class="product-card__image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
            <div class="gradient-bg product-card__badget">
                <h2>{{ $product->title }}</h2>
                <p>{{ $product->final_price }} сом</p>
            </div>
        </a>

        <div class="product-card__sizes">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            @foreach ($product->sizes()->orderBy('priority')->get() as $size)
                @if(!$loop->first)
                    <span>–</span>
                @endif
                <div>
                    <input type="radio" class="product-card__radio" name="size" value="{{ $size->title }}" id="{{$size->title . 'product' . $product->id }}" @if($loop->first) checked @endif>
                    <label for="{{$size->title . 'product' . $product->id }}">{{ $size->title }}</label>
                </div>
            @endforeach
        </div>

        <div class="product-card__actions">
            <button class="gradient-bg" type="button" data-action="buy-on-click">Купить в один
                <img src="{{ asset('img/main/tap.png') }}" alt="tap">
            </button>
    
            <button class="gradient-bg" type="button" data-action="add-into-basket">
                @php
                    $existsInBasket = false;

                    foreach ($productsInBasket as $prodInBask) {
                        if($prodInBask['product_id'] == $product->id) {
                            $existsInBasket = true;
                        }
                    }
                @endphp

                @if($existsInBasket) 
                    Убрать из корзины <img src="{{ asset('img/main/remove-from-basket.png') }}" alt="remove from basket">
                @else
                    В корзину <img src="{{ asset('img/main/add-to-basket.png') }}" alt="add into basket">
                @endif
            </button>
        </div>
    </form>
</div>