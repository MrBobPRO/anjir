@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('products.destroy') }}" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- empty space for checkbox --}}
                <th width="20"></th>

                <th width="120">
                    Изображение
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'title' ? 'active' : ''}}" href="{{route('dashboard.products.index')}}?page={{$activePage}}&orderBy=title&orderType={{$reversedOrderType}}">Заголовок</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'final_price' ? 'active' : ''}}" href="{{route('dashboard.products.index')}}?page={{$activePage}}&orderBy=final_price&orderType={{$reversedOrderType}}">Цена (сом)</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'discount' ? 'active' : ''}}" href="{{route('dashboard.products.index')}}?page={{$activePage}}&orderBy=discount&orderType={{$reversedOrderType}}">Скидка (%)</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.products.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата добавление</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($products as $product)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$product->id}}">
                                <input id="item{{$product->id}}" type="checkbox" name="id[]" value="{{$product->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td><img class="main-table__product-image" src="{{ asset('img/products/' . $product->image) }}"></td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->final_price }}</td>
                    <td>{{ $product->discount }}</td>
                    <td>{{ Carbon\Carbon::create($product->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm:ss') }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('products.show', $product->id) }}"
                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>
        
                            <a class="button--secondary" href="{{ route('products.edit', $product->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $product->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
    {{ $products->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'products.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection