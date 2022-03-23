@props(['product'])

<div class="product-card">
    <div class="product-card__appearance">
        @if ($product->discount)
            <span class="product-card__discount">-{{ $product->discount }}%</span>
        @endif
        <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
        <div class="gradient-bg">
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->price }} сом</p>
        </div>
    </div>

    <form class="product-card__form" action="#">
        @foreach ($product->sizes as $size)
            @if(!$loop->first)
                <span>–</span>
            @endif
            <div>
                <input type="radio" name="size" value="{{ $size->title }}" id="{{$size->title . $product->id }}" @if($loop->first) checked @endif>
                <label for="{{$size->title . $product->id }}">{{ $size->title }}</label>
            </div>
        @endforeach
    </form>

    <div class="product-card__actions">
        <button class="gradient-bg buy-on-click">Купить в один
            <span class="material-icons">ads_click</span>
        </button>

        <button class="gradient-bg add-into-basket">В корзину
            <span class="material-icons">add_shopping_cart</span>
        </button>
    </div>
</div>