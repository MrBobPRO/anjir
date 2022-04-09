@extends('layouts.app')

@section('title', $category->name)

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
                    <x-products-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection