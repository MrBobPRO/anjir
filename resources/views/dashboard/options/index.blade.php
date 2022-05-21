@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="javascript:void(0)" method="POST" class="table-form" id="table-form">
    @csrf
    {{-- Table start --}}
    <table class="main-table" cellpadding = "8" cellspacing = "10">
        {{-- Table Head start --}}
        <thead>
            <tr>
                {{-- empty space for checkbox --}}
                <th width="20"></th>

                <th>
                    Заголовок
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($options as $option)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$option->id}}">
                                <input id="item{{$option->id}}" type="checkbox" name="id[]" value="{{$option->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $option->title }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--secondary" href="{{ route('options.edit', $option->id) }}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать">
                                <span class="material-icons">edit</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
    {{ $options->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}

@include('dashboard.modals.multiple-destroy')

@endsection