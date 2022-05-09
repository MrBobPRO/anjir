@extends('dashboard.layouts.app')
@section("main")

<form action="#" method="POST" class="form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="required">Имя</label>
        <input class="form-input" type="text" value="{{ $feedback->name }}" readonly>
    </div>

    <div class="form-group">
        <label class="required">Телефон</label>
        <input class="form-input" type="text" value="{{ $feedback->phone }}" readonly>
    </div>

    <div class="form-group">
        <label class="required">Дата</label>
        <input class="form-input" type="text" value="{{ Carbon\Carbon::create($feedback->created_at)->locale('ru')->isoFormat('DD MMMM YYYY HH:mm:ss') }}" readonly>
    </div>

    <div class="form__actions">
        <button class="button button--danger" type="button" data-bs-toggle="modal" data-bs-target="#destroy-single-modal">
            <span class="material-icons">remove_circle</span> Удалить
        </button>
    </div>

</form>

@include('dashboard.modals.single-destroy', ['destroyRoute' => 'feedbacks.destroy', 'itemId' => $feedback->id ])

@endsection