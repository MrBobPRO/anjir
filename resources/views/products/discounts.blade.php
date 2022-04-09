@extends('layouts.app')

@section('title', 'Скидки')

@section('main')

<main class="discounts-page" role="main">
    <section class="main-title-section">
        <div class="main-container main-title-container">
            <h1 class="gradient-text main-title">Скидки</h1>
            <div class="category-switcher">
                <a href="{{ route('discounts.show', 'zhenskoe') }}" class="gradient-text @if($categoryUrl == 'zhenskoe') active @endif">жен</a>
                <div class="gradient-bg"></div>
                <a href="{{ route('discounts.show', 'muzhskoe') }}" class="gradient-text @if($categoryUrl == 'muzhskoe') active @endif"">муж</a>
            </div>
            <span></span>
        </div>
    </section>

    <x-main-carousel />

    <section class="products-list-section">
        <div class="main-container products-list-section__inner">
            <div class="products-list">
                @foreach ($products as $product)
                    <x-products-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection