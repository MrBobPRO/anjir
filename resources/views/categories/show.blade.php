@extends('layouts.app')

@section('main')

<main class="category-page" role="main">
    <section class="main-title-section">
        <div class="main-container main-title-container">
            <h1 class="gradient-text main-title">{{ $category->name }}</h1>
            <span></span>
        </div>
    </section>

    <x-main-carousel />

    <section class="novelty categories-novelty">
        <div class="main-container novelty__inner">
            <x-novelty-carousel :products="$novelty" />
        </div>
    </section>

    <section class="products-list-section">
        <div class="main-container products-list-section__inner">
            <div class="products-list">
                @foreach ($products as $product)
                    <div class="product-card">
                        <div class="product-card__appearance">
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
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection