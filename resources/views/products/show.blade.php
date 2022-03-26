@extends('layouts.app')

@section('main')

<main class="products-show-page" role="main">
    <section class="main-title-section">
        <div class="main-container main-title-container">
            <h1 class="gradient-text main-title">{{ $title }}</h1>
            <span></span>
        </div>
    </section>

    <section class="product-info">
        <div class="main-container product-info__inner">
            <img src="{{ asset('img/products/' . $product->image) }}" class="product-info__image" alt="{{ $product->title }}">
            <div class="product-info__content">
                <div class="gradient-bg product-info__tag">
                    <h2>{{ $product->title }}</h2>
                    <p>{{ $product->price }} сом</p>
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
                    <button class="gradient-bg" data-action="show-modal" data-target-id="buy-on-click-product-show-modal">Купить в один
                        <img src="{{ asset('img/main/tap.png') }}" alt="tap">
                    </button>
            
                    <button class="gradient-bg add-into-basket">В корзину
                        <img src="{{ asset('img/main/add-to-basket.png') }}" alt="add to basket">
                    </button>
                </div>

                <p class="product-info__description">{{ $product->description }}</p>
            </div>
        </div>
    </section>

    <section class="similar-products">
        <div class="main-container similar-products__inner">
            <div class="main-title-container">
                <h1 class="gradient-text main-title">похожее</h1>
                <span></span>
            </div>

            <div class="products-list">
                @foreach ($similarProducts as $similarProduct)
                    <x-products-card :product="$similarProduct" />
                @endforeach
            </div>
        </div>
    </section>

    <div class="main-modal buy-on-click-modal" id="buy-on-click-product-show-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-background" data-action="hide-modal" data-target-id="buy-on-click-product-show-modal"></div>
        <div class="modal-dialog gradient-bg">
            <div class="modal-content">
                <img src="{{ asset('img/main/sliced-anjir.png') }}" class="modal-content__background">
                <h2 class="modal-title">Купить в один клик</h2>
                <img class="modal-image" id="buy-on-click-product-show-modal-image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
    
                <form action="{{ route('orders.buy-on-click') }}" method="POST" class="modal-form" id="buy-on-click-product-show-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="modal-sizes" id="product-show-modal-sizes">
                        @foreach ($product->sizes as $size)
                            @if(!$loop->first)
                                <span>–</span>
                            @endif
                            <div>
                                <input type="radio" name="size" value="{{ $size->title }}" id="{{$size->title . 'product' . $product->id . 'modal' }}" @if($loop->first) checked @endif>
                                <label for="{{$size->title . 'product' . $product->id . 'modal' }}">{{ $size->title }}</label>
                            </div>
                        @endforeach
                    </div>
    
                    <div class="counter">
                        <button type="button" class="decrement-amount">–</button>
                        <input type="text" name="amount" value="1" class="only-numbers" id="buy-on-click-product-show-modal-amount-input" required>
                        <button type="button" class="increment-amount">+</button>
                    </div>
    
                    <input type="text" name="name" placeholder="Ф.И.О" required>
                    <input type="text" name="phone" placeholder="номер телефона" required>
                    <button>заказать</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection