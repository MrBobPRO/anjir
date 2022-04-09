@extends('layouts.app')

@section('title', 'О Нас')

@section('main')

<main class="about-us-page" role="main">
    <section class="main-title-section">
        <div class="main-container main-title-container">
            <h1 class="gradient-text main-title">О Нас</h1>
            <span></span>
        </div>
    </section>

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

    <section class="about-us-text">
        <div class="main-container about-us-text__inner">
            <div class="about-us-text__bg gradient-bg">
                <h1>Добро пожаловать в ANJIR!</h1>
                <p>Google, предназначенная для автоматического перевода части текста или веб-страницы на другой язык. Для некоторых языков пользователям предлагаются варианты переводов, например, для технических терминов, которые должны быть в будущем включены в обновления системы перевода. Google, предназначенная для автоматического перевода части текста или веб-страницы на другой язык. Для некоторых языков пользователям предлагаются варианты переводов, например, для технических терминов, которые должны быть в будущем включены в обновления системы перевода.</p>
                <img src="{{ asset('img/main/sliced-anjir.png') }}" alt="slised anjir">
            </div>
        </div>
    </section>

</main>

@endsection