<header class="header">
    {{-- Header Top start --}}
    <div class="main-container header__top">
        <a class="logo header__logo" href="{{ route('home') }}">
            <img src="{{ asset('img/main/logo.png') }}" alt="Anjir logo">
        </a>

        <form action="#" class="search gradient-bg">
            <input type="text" class="search__input" autocomplete="off" id="search-input" placeholder="поиск товара" oninput="debounceSearch()">
            <span class="material-icons-outlined search__icon">search</span>
            
            <ul class="search-results" id="search-results"></ul>
        </form>

        <div class="header__actions">
            <button class="header__actions-item order-call gradient-bg" data-action="show-modal" data-target-id="feedback-modal">
                <span class="material-icons-outlined">phone_in_talk</span>
            </button>

            <a href="{{ route('basket.index') }}" class="header__actions-item header__basket gradient-bg">
                <span class="material-icons-outlined header__basket-icon">local_mall</span>
                <span class="header__basket-count" id="basket-products-count">{{ $productsInBasket }}</span>
            </a>

            <button class="header__actions-item menu-toggler gradient-bg" data-action="show-modal" data-target-id="feedback-modal">
                <span class="material-icons-outlined">menu</span>
            </button>
        </div>
    </div> {{-- Header Top end --}}

    {{-- Header Nav start --}}
    <nav class="header__nav gradient-bg">
        <img class="header__nav-image" src="{{ asset('img/main/sliced-anjir-white.png') }}" alt="sliced anjir">
        <ul class="main-container">
            <li><a href="{{ route('about-us') }}">О нас</a></li>
            @foreach ($categories as $category)
                <li><a href="{{ route('categories.show', $category->url) }}">{{ $category->name }}</a></li>
            @endforeach
            <li><a class="header__nav-discounts" href="{{ route('discounts.show', 'zhenskoe') }}">Скидки <span>%</span></a></li>
        </ul>
    </nav> {{-- Header Nav end --}}
</header>