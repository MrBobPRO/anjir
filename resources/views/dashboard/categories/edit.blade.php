@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('categories.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $category->id }}">

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="name" type="text" value="{{ $category->name }}" required>
    </div>

    <div class="form-group">
        <label class="required">Приоритет</label>
        <input class="form-input" name="priority" type="number" value="{{ $category->priority }}" required>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Обновить
        </button>

        <button class="button button--danger" type="button" data-bs-toggle="modal" data-bs-target="#destroy-single-modal">
            <span class="material-icons">remove_circle</span> Удалить
        </button>
    </div>

</form>

@include('dashboard.modals.single-destroy', ['destroyRoute' => 'categories.destroy', 'itemId' => $category->id ])

@endsection