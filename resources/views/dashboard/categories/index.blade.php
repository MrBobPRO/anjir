@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('categories.destroy') }}" method="POST" class="table-form" id="table-form">
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
                    <a class="{{$orderType}} {{$orderBy == 'name' ? 'active' : ''}}" href="{{route('dashboard.categories.index')}}?page={{$activePage}}&orderBy=name&orderType={{$reversedOrderType}}">Заголовок</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'priority' ? 'active' : ''}}" href="{{route('dashboard.categories.index')}}?page={{$activePage}}&orderBy=priority&orderType={{$reversedOrderType}}">Приоритет</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.categories.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата добавления</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$category->id}}">
                                <input id="item{{$category->id}}" type="checkbox" name="id[]" value="{{$category->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->priority }}</td>
                    <td>{{ Carbon\Carbon::create($category->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm:ss') }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('categories.show', $category->url) }}"
                                target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>
        
                            <a class="button--secondary" href="{{ route('categories.edit', $category->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $category->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
    {{ $categories->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'categories.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection