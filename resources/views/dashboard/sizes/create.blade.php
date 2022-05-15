@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('sizes.store') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="title" type="text" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label class="required">Приоритет</label>
        <input class="form-input" name="priority" type="number" value="1" required>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Добавить
        </button>
    </div>

</form>

@endsection