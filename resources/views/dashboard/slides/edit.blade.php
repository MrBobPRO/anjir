@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('slides.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $slide->id }}">

    <div class="form-group">
        <label class="required">Выберите на какой странице отображать слайдер</label>
        <select class="selectize-singular" name="category_id" required>
            <option value="0" @if($slide->category_id == 0) selected @endif>Главная</option>
            <option value="-1" @if($slide->category_id == -1) selected @endif>Скидки</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($slide->category_id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Изображение. Все изображение слайдера должны иметь одинаковые размеры! Рек/размер (1300x272 px)</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg"
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/slides/' . $slide->image)}}" id="local-image">
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

@include('dashboard.modals.single-destroy', ['destroyRoute' => 'slides.destroy', 'itemId' => $slide->id ])

@endsection