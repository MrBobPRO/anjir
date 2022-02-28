<header class="header">
    <div class="main-container header__inner">
        {{-- Logo start --}}
        <a class="header__logo" href="{{ route('home') }}">
            <img src="{{ asset('img/main/logo.svg') }}" alt="Belinda Ophthalmology logo">
        </a>  {{-- Logo end --}}

        <nav class="header__nav">
            <ul>
                <li>
                    <a @if($route == 'home') class="active" @endif href="{{ route('home') }}">Главная</a>
                </li>

                <li>
                    <a @if($route == 'researches.index') class="active" @endif href="{{ route('home') }}">Исследования</a>
                </li>

                <li>
                    <a @if($route == 'products.index') class="active" @endif href="{{ route('home') }}">Продукты</a>
                </li>
            </ul>
        </nav>

        <div class="header__contacts">
            <a href="https://salomat.tj" target="_blank">
                <div>
                    <h3>Покупайте нашу</h3>
                    <p>продукцию с выгодой</p>
                </div>
                <span class="material-icons-outlined">shopping_cart</span>
            </a>

            <a href="tel:+992918000000">
                <div>
                    <h3>+ 992 918 00 00 00</h3>
                    <p>Свяжитесь с нами</p>
                </div>
                <span class="material-icons-outlined">map</span>
            </a>
        </div>

    </div>  {{-- Header Inner end --}}
</header>