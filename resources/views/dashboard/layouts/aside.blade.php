<aside class="aside" id="aside">
    <span class="material-icons aside-toggler" onclick="toggleAside()" id="aside-toggler">chevron_left</span>

    <img class="aside__avatar" src="{{ asset('img/dashboard/admin.jpg') }}">

    <nav class="aside__nav">
        <ul class="aside__menu">
            <li>
                <a href="{{route('home')}}" target="_blank">
                    <span class="material-icons">home</span> Перейти на сайт
                </a>
            </li>

            <li>
                <a class="@if(strpos($route, 'orders') !== false || $route == 'dashboard.index') active @endif" href="{{route('dashboard.index')}}">
                    <span class="material-icons">medication</span> Заказы
                    @if($newOrdersCount > 0)
                        ({{ $newOrdersCount }})
                    @endif
                </a>
            </li>

            <li>
                <a class="@if(strpos($route, 'feedbacks') !== false) active @endif" href="{{route('dashboard.feedbacks.index')}}">
                    <span class="material-icons">phone_in_talk</span> Обрат. связь
                    @if($newFeedbacksCount > 0)
                        ({{ $newFeedbacksCount }})
                    @endif
                </a>
            </li>

            <li>
                <a class="@if(strpos($route, 'products') !== false) active @endif" href="{{route('dashboard.products.index')}}">
                    <span class="material-icons">article</span> Товары
                </a>
            </li>

            <li>
                <a class="@if(strpos($route, 'mailing') !== false) active @endif" href="{{route('dashboard.index')}}">
                    <span class="material-icons">email</span> Категории
                </a>
            </li>

            <li>
                <a class="@if(strpos($route, 'slides') !== false) active @endif" href="{{route('dashboard.index')}}">
                    <span class="material-icons">collections</span> Слайды
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><span class="material-icons">logout</span> Выйти</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>