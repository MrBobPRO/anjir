<header class="header" id="header">
    <h1 class="header__title">
        {{-- first level --}}
        @if(strpos($route, 'orders') !== false  || $route == 'dashboard.index') Заказы 
        @elseif(strpos($route, 'researches') !== false) Исследования
        @elseif(strpos($route, 'slides') !== false) Слайдер
        @elseif(strpos($route, 'mailing') !== false) Email рассылка
        @endif

        {{-- second level for CREATE --}}
        @if($route == 'products.relations.create') / {{ $relationTitle }} / Добавить
        @elseif(strpos($route, 'create') ) / Добавить
        {{-- second level for EDIT --}}
        @elseif($route == 'dashboard.orders.show') / № {{ $order->id }}
        @elseif($route == 'products.relations.edit') / {{ $relationTitle }} / {{ $item->title }}
        @elseif($route == 'researches.edit') / {{ $research->title }}
        @elseif($route == 'slides.edit') / {{ $slide->title }}
        @elseif($route == 'products.relations.index') / {{ $relationTitle }}
        @endif

        {{-- items count --}}
        {{-- @if(strpos($route, 'index')) ({{ count($items) }}) @endif --}}
    </h1>

    <div class="header__actions">
        {{-- Create Buttons --}}
        @switch($route)
            @case('dashboard.slides.index')
                <a href="{{route('slides.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break
        @endswitch

        {{-- Multiple Delete buttons for all index routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('dashboard.researches.index')
            @case('dashboard.slides.index')
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