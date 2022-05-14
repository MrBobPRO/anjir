@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="title" type="text" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label class="required">Цена</label>
        <input class="form-input" name="price" type="number" id="product-price-input" data-on-change="calculate-final-price" value="{{ old('price') }}" required>
    </div>

    <div class="form-group">
        <label class="required">Скидка (%)</label>
        <input class="form-input" name="discount" type="number" id="discount-input" data-on-change="calculate-final-price" value="{{ old('discount') != '' ? old('discount') : 0 }}" required>
    </div>

    <div class="form-group">
        <label class="required">Цена со скидкой</label>
        <input class="form-input" type="number" id="final-price-input" name="final_price" value="{{ old('final_price') != '' ? old('final_price') : 0 }}" readonly>
    </div>

    <div class="form-group">
        <label class="required">Изображение</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg" required
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/dashboard/default-image.png') }}" id="local-image">
    </div>

    <div class="form-group">
        <label class="required">Категории</label>
        <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Размеры</label>
        <select class="selectize-multiple" name="sizes[]" multiple="multiple" required>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Описание</label>
        <textarea class="form-textarea" name="description" rows="5" required>{{ old("description") }}</textarea>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Добавить
        </button>
    </div>

</form>

@endsection