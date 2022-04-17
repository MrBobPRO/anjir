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
        
                <div class="product-card__divider-left">
                    <div class="owl-carousel-container product-show-carousel-container">
                        <div class="owl-carousel product-show-carousel" id="product-show-carousel">
                            <div class="product-show-carousel__item">
                                <img class="product-show-carousel__image" src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
                            </div>

                            @foreach ($product->images as $image)
                                <div class="product-show-carousel__item">
                                    <img class="product-show-carousel__image" src="{{ asset('img/products/additional/' . $image->name) }}" alt="{{ $product->title }}">
                                </div>
                            @endforeach
                        </div>

                        @if(count($product->images))
                            <span class="material-icons-outlined unselectable owl-nav owl-nav--prev" id="product-show-carousel-prev-nav">arrow_back_ios</span>
                            <span class="material-icons-outlined unselectable owl-nav owl-nav--next" id="product-show-carousel-next-nav">arrow_forward_ios</span>
                        @endif
                    </div>

                    @if(count($product->images))
                        <div class="owl-carousel-container lightbox-carousel-container">
                            <div class="owl-carousel lightbox-carousel" id="lightbox-carousel">
                                @foreach ($product->images as $image)
                                    <div class="lightbox-carousel__item">
                                        <img class="lightboxed" rel="group1" src="{{ asset('img/products/additional/' . $image->name) }}" alt="{{ $product->title }}" data-link="{{ asset('img/products/additional/' . $image->name) }}" >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
        
                <div class="product-card__divider-right">
                    <div class="gradient-bg product-card__badget">
                        <h2>{{ $product->title }}</h2>
                        <p>{{ $product->final_price }} сом</p>
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