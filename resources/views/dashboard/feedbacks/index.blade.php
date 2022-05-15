@extends('dashboard.layouts.app')
@section("main")

@include('dashboard.layouts.search')

{{-- Main form start --}}
<form action="{{ route('feedbacks.destroy') }}" method="POST" class="table-form" id="table-form">
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
                    <a class="{{$orderType}} {{$orderBy == 'name' ? 'active' : ''}}" href="{{route('dashboard.feedbacks.index')}}?page={{$activePage}}&orderBy=name&orderType={{$reversedOrderType}}">Имя</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'phone' ? 'active' : ''}}" href="{{route('dashboard.feedbacks.index')}}?page={{$activePage}}&orderBy=phone&orderType={{$reversedOrderType}}">Телефон</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'new' ? 'active' : ''}}" href="{{route('dashboard.feedbacks.index')}}?page={{$activePage}}&orderBy=new&orderType={{$reversedOrderType}}">Статус</a>
                </th>

                <th>
                    <a class="{{$orderType}} {{$orderBy == 'created_at' ? 'active' : ''}}" href="{{route('dashboard.feedbacks.index')}}?page={{$activePage}}&orderBy=created_at&orderType={{$reversedOrderType}}">Дата</a>
                </th>

                <th width="120">
                    Действие
                </th>
            </tr>
        </thead>  {{-- Table Head end --}}

        {{-- Table Body start --}}
        <tbody>
            @foreach ($feedbacks as $feedback)
                <tr>
                    {{-- Checkbox for multidelete --}}
                    <td width="20">
                        <div class="checkbox">
                            <label for="item{{$feedback->id}}">
                                <input id="item{{$feedback->id}}" type="checkbox" name="id[]" value="{{$feedback->id}}">
                                <span></span>
                            </label>
                        </div>
                    </td>

                    <td>{{ $feedback->id }}</td>
                    <td>{{ $feedback->name }}</td>
                    <td>{{ $feedback->phone }}</td>
                    <td>{!! $feedback->new ? '<span class="new">Новый</span>' : 'Просмотрено' !!}</td>
                    <td>{{ Carbon\Carbon::create($feedback->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm:ss') }}</td>

                    {{-- Actions --}}
                    <td width="120">
                        <div class="table__actions">
                            <a class="button--main" href="{{ route('dashboard.feedbacks.show', $feedback->id) }}"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Посмотреть">
                                <span class="material-icons">visibility</span>
                            </a>

                            <button class="button--danger" type="button" onclick="showSingleDestroyModal({{ $feedback->id }})"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить">
                                <span class="material-icons">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>  {{-- Table Body end --}}
    </table>  {{-- Table end --}}
    
    {{ $feedbacks->links('dashboard.layouts.pagination') }}
</form>  {{-- Main form end --}}


@include('dashboard.modals.single-destroy', ['destroyRoute' => 'feedbacks.destroy', 'itemId' => '0'])
@include('dashboard.modals.multiple-destroy')

@endsection