@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('options.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $option->id }}">

    <div class="form-group">
        <label class="required">Текст</label>
        <textarea class="form-textarea @if($option->wysiwyg) simditor-wysiwyg @endif" name="value" required>{{ $option->value }}</textarea>
    </div>

    <div class="form__actions">
        <button class="button button--success" type="submit">
            <span class="material-icons">done_all</span> Обновить
        </button>
    </div>

</form>

@endsection