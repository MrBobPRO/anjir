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
                    <button class="gradient-bg buy-on-click">Купить в один
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
                @foreach ($similarProducts as $product)
                    <x-products-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection