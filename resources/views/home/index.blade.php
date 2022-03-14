@extends('layouts.app')

@section('main')

<main class="home-page" role="main">
    <x-main-carousel />

    <section class="advantages">
        <div class="main-container advantages__inner">
            <ul class="advantages__list">
                <li class="gradient-bg">
                    <h3>Супер доставка</h3>
                    <img src="{{ asset('img/advantages/fast-delivery.png') }}" alt="fast delivery">
                </li>

                <li class="gradient-bg">
                    <h3>Доступная оплата</h3>
                    <img src="{{ asset('img/advantages/payment.png') }}" alt="payment">
                </li>

                <li class="gradient-bg">
                    <h3>Выгодная цена</h3>
                    <img src="{{ asset('img/advantages/best-price.png') }}" alt="best price">
                </li>

                <li class="gradient-bg">
                    <h3>Большой выбор</h3>
                    <img src="{{ asset('img/advantages/big-choice.png') }}" alt="big choice">
                </li>
            </ul>
        </div>
    </section>

    <section class="novelty">
        <div class="novelty__title gradient-bg">Новинка</div>
        <div class="main-container novelty__inner">
            <x-novelty-carousel :products="$novelty" />
        </div>
    </section>

    <section class="home-stock">
        <div class="main-container home-stock__inner">
            <div class="home-stock__item">
                <img src="{{ asset('img/products/1.jpg') }}">
                <a href="#" class="gradient-bg">Выбрать товар</a>
            </div>

            <span class="home-stock__sign">+</span>

            <div class="home-stock__item">
                <img src="{{ asset('img/products/2.jpg') }}">
                <a href="#" class="gradient-bg">Выбрать товар</a>
            </div>

            <span class="home-stock__sign">=</span>

            <div class="home-stock__action">
                <h2>Скидка<br>-10%</h2>
                <a href="#" class="gradient-bg">Заказать</a>
            </div>
        </div>
    </section>
</main>

@endsection