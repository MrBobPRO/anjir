@extends('layouts.app')

@section('title', 'Корзина')

@section('main')

<main class="basket-page" role="main">
    <section class="products-list-section">
        <div class="main-container products-list-section__inner">
            <div class="main-title-container">
                <h1 class="gradient-text main-title">Моя корзина</h1>
                <span></span>
            </div>

            <div class="products-list">
                @if($items)
                    @foreach ($items as $item)
                        @php
                            $product = App\Models\Product::find($item['product_id']);
                        @endphp

                        <div class="product-card">
                            <form action="#" class="product-card__form">
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
                                            <input type="radio" class="product-card__radio" name="size" value="{{ $size->title }}" id="{{$size->title . 'product' . $product->id }}" @if($size->title == $item['size']) checked @endif>
                                            <label for="{{$size->title . 'product' . $product->id }}">{{ $size->title }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="counter gradient-bg">
                                    <button type="button" class="decrement-amount">–</button>
                                    <input type="text" name="amount" value="1" class="only-numbers" id="buy-on-click-modal-amount" required>
                                    <button type="button" class="increment-amount">+</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @else
                    <h3>Ваша корзина пуста!</h3>
                @endif
            </div>

            @if($items)
                <form class="checkout-form" id="checkout-form">
                    @csrf

                    <input type="text" class="gradient-bg" name="name" id="checkout-form-name" placeholder="Ф.И.О" required>
                    <input type="text" class="gradient-bg" name="phone" id="checkout-form-phone" placeholder="номер телефона" required>
                    <input type="text" class="gradient-bg" name="promocode" id="checkout-form-promocode" placeholder="введите промокод">
                    <button class="gradient-bg">заказать</button>
                </form>
            @endif
        </div>
    </section>
</main>

@endsection