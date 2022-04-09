@extends('layouts.app')

@section('title', $product->title)

@section('meta-tags')
    @php
        $shareText = App\Helpers\Helper::cleanShareText($product->description);
    @endphp

    <meta name="description" content="{{ $shareText }}">
    <meta property="og:description" content="{{ $shareText }}">
    <meta property="og:title" content="{{ $product->title }}" />
    <meta property="og:image" content="{{ asset('img/products/' . $product->image) }}">
    <meta property="og:image:alt" content="{{ $product->title }}">
    <meta name="twitter:title" content="{{ $product->title }}">
    <meta name="twitter:image" content="{{ asset('img/products/' . $product->image) }}">
@endsection

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
            <form action="#" class="product-card__form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
        
                <img class="product-card__image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
        
                <div class="product-card__divider">
                    <div class="gradient-bg product-card__badget">
                        <h2>{{ $product->title }}</h2>
                        <p>{{ $product->price }} сом</p>
                    </div>

                    <div class="product-card__sizes">
                        @foreach ($product->sizes as $size)
                            @if(!$loop->first)
                                <span>–</span>
                            @endif
                            <div>
                                <input type="radio" name="size" value="{{ $size->title }}" id="{{$size->title . 'product' . $product->id }}" @if($loop->first) checked @endif>
                                <label for="{{$size->title . 'product' . $product->id }}">{{ $size->title }}</label>
                            </div>
                        @endforeach
                    </div>
            
                    <div class="product-card__actions">
                        <button class="gradient-bg" type="button" data-action="show-modal" data-target-id="products-show-buy-on-click-modal">Купить в один
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
                                Убрать из корзины <img src="/img/main/remove-from-basket.png" alt="remove from basket">
                            @else
                                В корзину <img src="{{ asset('img/main/add-to-basket.png') }}" alt="add into basket">
                            @endif
                        </button>
                    </div>
            
                    <p class="product-card__description">{{ $product->description }}</p>
                </div>
            </form>
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
</main>

@include('modals.products-show-buy-on-click')

@endsection