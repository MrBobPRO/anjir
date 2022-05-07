@extends('dashboard.layouts.app')
@section("main")

<div class="orders-show-page">
    @php
        $totalPrice = 0;
        foreach ($order->products as $prod) {
            $totalPrice += $prod->final_price * $prod->pivot->amount;
        }
    @endphp

    <div class="orders-show-page__info">
        <p class="orders-show-page__info-text">Имя заказчика: {{ $order->name }}</p>
        <p class="orders-show-page__info-text">Номер телефон заказчика: {{ $order->phone }}</p>
        @if ($order->promocode)
            <p class="orders-show-page__info-text">Промокод: {{ $order->promocode }}</p>
        @endif
        <p class="orders-show-page__info-text">Общая цена заказа: <span class="orders-show-page__info-highlight">{{ $totalPrice }} сом.</span></p>
    </div>

    <ul class="order-list">
        @foreach ($order->products as $product)
            <li class="order-list__item">
                <img class="order-list__item-image" src="{{ asset('img/products/' . $product->image) }}">

                <div class="order-list__item-block">
                    <p class="order-list__item-title">{{ $product->title }}</p>
                    <p class="order-list__item-text">Цена за единицу: {{ $product->price }} сом.</p>
                    <p class="order-list__item-text">Скидка за единицу: {{ $product->discount }}%</p>
                    <p class="order-list__item-text">Финальная цена за единицу: <span class="order-list__highlight">{{ $product->final_price }} сом.</span></p>
                </div>

                <div class="order-list__item-block">
                    <p class="order-list__item-title">Заказали:</p>
                    <p class="order-list__item-text">Размер: {{ $product->pivot->size }}</p>
                    <p class="order-list__item-text">Количество: <span class="order-list__highlight">{{ $product->pivot->amount }}</span></p>
                </div>

                <div class="order-list__item-block">
                    <p class="order-list__item-title">Итого :</p>
                    <p class="order-list__item-text">Общая цена за товар: <span class="order-list__highlight">{{ $product->final_price * $product->pivot->amount }} сом.</span></p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection