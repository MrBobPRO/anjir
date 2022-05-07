@extends('dashboard.layouts.app')
@section("main")

{{-- @if(!$errors->any() && $activePage == 1)
    <div class="alert alert-warning warning-container">
        <span class="material-icons">warning</span>
        При удалении продукта, также удалятся исследования по этому продукту
    </div>
@endif --}}

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('orders.destroy') }}" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- empty space for checkbox --}}
                <th width="20"></th>

                <th>
                    №
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'name' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=name&orderType={{$reversedOrderType}}">Имя</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'phone' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=phone&orderType={{$reversedOrderType}}">Телефон</a>
                </th>

                <th>
                    Заказал
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'new' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=new&orderType={{$reversedOrderType}}">Статус</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата заказа</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$order->id}}">
                                <input id="item{{$order->id}}" type="checkbox" name="id[]" value="{{$order->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        @foreach ($order->products as $prod)
                            {{ ($loop->index+1) . ') ' . $prod->title . ' размер: ' . $prod->pivot->size . ' количество: ' . $prod->pivot->amount }}
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>{!! $order->new ? '<span class="new">Новый</span>' : 'Просмотрено' !!}</td>
                    <td>{{ Carbon\Carbon::create($order->created_at)->locale("ru")->isoFormat("DD MMMM YYYY HH:mm:ss") }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('dashboard.orders.show', $order->id) }}"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $order->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}

    {{ $orders->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'orders.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection