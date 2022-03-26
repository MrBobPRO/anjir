@props(['product'])

<div class="product-card">
    <a href="{{ route('products.show', $product->id) }}" class="product-card__appearance">
        @if ($product->discount)
            <span class="product-card__discount">-{{ $product->discount }}%</span>
        @endif
        <img class="product-card__image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
        <div class="gradient-bg">
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->price }} сом</p>
        </div>
    </a>

    <input type="hidden" value="{{ $product->id }}" class="product-card__id">

    <form class="product-card__form" action="#">
        @foreach ($product->sizes as $size)
            @if(!$loop->first)
                <span>–</span>
            @endif
            <div>
                <input type="radio" name="size" value="{{ $size->title }}" id="{{$size->title . 'product' . $product->id }}" @if($loop->first) checked @endif>
                <label for="{{$size->title . 'product' . $product->id }}">{{ $size->title }}</label>
            </div>
        @endforeach
    </form>

    <div class="product-card__actions">
        <button class="gradient-bg buy-on-click">Купить в один
            <img src="{{ asset('img/main/tap.png') }}" alt="tap">
        </button>

        <button class="gradient-bg add-into-basket" data-action="add-into-basket" data-size-input="">В корзину
            <img src="{{ asset('img/main/add-to-basket.png') }}" alt="add into basket">
        </button>
    </div>
</div>