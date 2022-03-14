@props(["products"])

<div class="novelty-carousel-container">
    <div class="owl-carousel novelty-carousel" id="novelty-carousel">
        @foreach ($products as $product)
            <a href="#" class="novelty-item">
                <div class="novelty-image-container">
                    <img src="{{ asset('img/products/' . $product->image) }}" alt="{{ $product->title }}">
                    <span>new</span>
                </div>
                <h2>{{ $product->title }}</h2>
                <p>{{ $product->price }} сом</p>
            </a>
        @endforeach
    </div>
</div>