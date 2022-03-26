@props(["products"])

<div class="novelty-carousel-container owl-carousel-container">
    <div class="owl-carousel novelty-carousel" id="novelty-carousel">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="novelty-item">
                <div class="novelty-image-container">
                    <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
                    <span>new</span>
                </div>
                <h2>{{ $product->title }}</h2>
                <p>{{ $product->price }} сом</p>
            </a>
        @endforeach
    </div>

    <span class="material-icons-outlined unselectable owl-nav owl-nav--prev" id="novelty-carousel-prev-nav">arrow_back_ios</span>
    <span class="material-icons-outlined unselectable owl-nav owl-nav--next" id="novelty-carousel-next-nav">arrow_forward_ios</span>
</div>