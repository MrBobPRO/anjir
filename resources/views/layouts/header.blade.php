<header class="header">
    {{-- Header Top start --}}
    <div class="main-container header__top">
        <a class="logo header__logo" href="{{ route('home') }}">
            <img src="{{ asset('img/main/logo.svg') }}" alt="Anjir logo">
        </a>

        <form action="#" class="search gradient-bg">
            <input type="text" class="search__input" name="keyword" placeholder="поиск товара">
            <span class="material-icons-outlined search__icon">search</span>
        </form>

        <div class="header__actions">
            <button class="order-call gradient-bg">
                <span class="material-icons-outlined">phone_in_talk</span>
            </button>

            <a href="#" class="header__basket gradient-bg">
                <span class="material-icons-outlined header__basket-icon">local_mall</span>
                <span class="header__basket-discont">+0</span>
            </a>
        </div>
    </div> {{-- Header Top end --}}

    {{-- Header Nav start --}}
    <nav class="header__nav gradient-bg">
        <ul class="main-container">
            <li><a href="{{ route('home') }}">О нас</a></li>
            <li><a href="{{ route('home') }}">Женское</a></li>
            <li><a href="{{ route('home') }}">Мужское</a></li>
            <li><a href="{{ route('home') }}">Аксессуары</a></li>
            <li><a href="{{ route('home') }}">Сумки</a></li>
            <li><a href="{{ route('home') }}">Скидки</a></li>
        </ul>
    </nav> {{-- Header Nav end --}}
</header>