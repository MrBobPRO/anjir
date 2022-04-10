@props(['slides'])

@if($slides && count($slides))
    <section class="main-carousel-container">
        <div class="owl-carousel main-container main-carousel" id="main-carousel">
            @foreach ($slides as $slide)
                <div class="main-carousel__item">
                    <img src="{{ asset('img/slides/' . $slide->image) }}">
                </div>
            @endforeach
        </div>
    </section>
@endif