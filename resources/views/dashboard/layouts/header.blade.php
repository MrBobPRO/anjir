<header class="header" id="header">
    <h1 class="header__title">
        {{-- first level --}}
        @if(strpos($route, 'orders') !== false  || $route == 'dashboard.index') Заказы 
        @elseif(strpos($route, 'feedbacks') !== false) Обратная связь
        @elseif(strpos($route, 'products') !== false) Товары
        @elseif(strpos($route, 'categories') !== false) Категории
        @elseif(strpos($route, 'slides') !== false) Слайды
        @elseif(strpos($route, 'sizes') !== false) Размеры
        @elseif(strpos($route, 'options') !== false) Тексты
        @endif

        {{-- First levels items count --}}
        @if(strpos($route, 'index')) ({{ count($items) }}) @endif

        {{-- second level for CREATE --}}
        @if(strpos($route, 'create') ) / Добавить
        {{-- second level for EDIT & SHOW --}}
        @elseif($route == 'dashboard.orders.show') / № {{ $order->id }}
        @elseif($route == 'dashboard.feedbacks.show') / № {{ $feedback->id }}
        @elseif($route == 'products.edit') / {{ $product->title }}
        @elseif($route == 'categories.edit') / {{ $category->name }}
        @elseif($route == 'slides.edit') / {{ $slide->id }}
        @elseif($route == 'sizes.edit') / {{ $size->title }}
        @elseif($route == 'options.edit') / {{ $option->title }}
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

            @case('dashboard.categories.index')
                <a href="{{route('categories.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break

            @case('dashboard.slides.index')
                <a href="{{route('slides.create')}}">
                    <span class="material-icons">add</span> Добавить
                </a>
            @break

            @case('dashboard.sizes.index')
            <a href="{{route('sizes.create')}}">
                <span class="material-icons">add</span> Добавить
            </a>
        @break
        @endswitch

        {{-- Multiple Delete buttons for all index page routes --}}
        @switch($route)
            @case('dashboard.index')
            @case('dashboard.feedbacks.index')
            @case('dashboard.products.index')
            @case('dashboard.categories.index')
            @case('dashboard.slides.index')
            @case('dashboard.sizes.index')
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