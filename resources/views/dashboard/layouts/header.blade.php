<header class="header" id="header">
    <h1 class="header__title">
        {{-- first level --}}
        @if(strpos($route, 'orders') !== false  || $route == 'dashboard.index') Заказы 
        @elseif(strpos($route, 'feedbacks') !== false) Обратная связь
        @elseif(strpos($route, 'products') !== false) Товары
        @elseif(strpos($route, 'slides') !== false) Слайдер
        @elseif(strpos($route, 'mailing') !== false) Email рассылка
        @endif

        {{-- First levels items count --}}
        @if(strpos($route, 'index')) ({{ count($items) }}) @endif

        {{-- second level for CREATE --}}
        @if(strpos($route, 'create') ) / Добавить
        {{-- second level for EDIT & SHOW --}}
        @elseif($route == 'dashboard.orders.show') / № {{ $order->id }}
        @elseif($route == 'dashboard.feedbacks.show') / № {{ $feedback->id }}
        @elseif($route == 'products.edit') / {{ $product->title }}
        @elseif($route == 'slides.edit') / {{ $slide->title }}
        @elseif($route == 'products.relations.index') / {{ $relationTitle }}
        @endif
    </h1>

    <div class="header__actions">
        {{-- Create Buttons --}}
        @switch($route)
            @case('dashboard.products.index')
                <a href="{{route('products.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break
        @endswitch

        {{-- Multiple Delete buttons for all index page routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('dashboard.feedbacks.index')
            @case('dashboard.products.index')
            @case('dashboard.mailing.index')
            @case('products.relations.index')
                <button onclick="toggleCheckboxes()">
                    <span class="material-icons">done_all</span> Отметить все
                </button>

                <button data-bs-toggle="modal" data-bs-target="#destroy-multiple-form">
                    <span class="material-icons">clear</span> Удалить отмеченные
                </button>
            @break
        @endswitch
    </div>
</header>