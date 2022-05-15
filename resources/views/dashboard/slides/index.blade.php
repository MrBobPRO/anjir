@extends('dashboard.layouts.app')
@section("main")

{{-- Main form start --}}
<form action="{{ route('slides.destroy') }}" method="POST" class="table-form" id="table-form">
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
                    Изображение
                </th>

                <th>
                    Страница
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($slides as $slide)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$slide->id}}">
                                <input id="item{{$slide->id}}" type="checkbox" name="id[]" value="{{$slide->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $slide->id }}</td>
                    <td><img class="main-table__slide-image" src="{{ asset('img/slides/' . $slide->image) }}"></td>
                    <td>
                        @if($slide->category_id == 0) Главная
                        @elseif($slide->category_id == -1) Скидки
                        @else {{ $slide->category->name }}
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--secondary" href="{{ route('slides.edit', $slide->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
        
                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $slide->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'slides.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection