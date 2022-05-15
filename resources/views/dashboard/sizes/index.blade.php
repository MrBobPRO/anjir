@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('sizes.destroy') }}" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- empty space for checkbox --}}
                <th width="20"></th>

                <th>
                    ID
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'title' ? 'active' : ''}}" href="{{route('dashboard.sizes.index')}}?page={{$activePage}}&orderBy=title&orderType={{$reversedOrderType}}">Заголовок</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'priority' ? 'active' : ''}}" href="{{route('dashboard.sizes.index')}}?page={{$activePage}}&orderBy=priority&orderType={{$reversedOrderType}}">Приоритет</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.sizes.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата добавления</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($sizes as $size)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$size->id}}">
                                <input id="item{{$size->id}}" type="checkbox" name="id[]" value="{{$size->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $size->id }}</td>
                    <td>{{ $size->title }}</td>
                    <td>{{ $size->priority }}</td>
                    <td>{{ Carbon\Carbon::create($size->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm:ss') }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--secondary" href="{{ route('sizes.edit', $size->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $size->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
    {{ $sizes->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'sizes.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection