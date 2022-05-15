@extends('dashboard.layouts.app')
@section("main")

<form action="{{ route('products.update') }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">

    <div class="form-group">
        <label class="required">Заголовок</label>
        <input class="form-input" name="title" type="text" value="{{ $product->title }}" required>
    </div>

    <div class="form-group">
        <label class="required">Цена</label>
        <input class="form-input" name="price" type="number" id="product-price-input" data-on-change="calculate-final-price" value="{{ $product->price }}" required>
    </div>

    <div class="form-group">
        <label class="required">Скидка (%)</label>
        <input class="form-input" name="discount" type="number" id="discount-input" data-on-change="calculate-final-price" value="{{ $product->discount }}" required>
    </div>

    <div class="form-group">
        <label class="required">Цена со скидкой</label>
        <input class="form-input" type="number" id="final-price-input" name="final_price" value="{{ $product->final_price }}" readonly>
    </div>

    <div class="form-group">
        <label class="required">Изображение</label>
        <input class="form-input" name="image" type="file" accept=".png, .jpg, .jpeg"
        data-action="show-image-from-local" data-target="local-image">

        <img class="form-image" src="{{ asset('img/products/' . $product->image) }}" id="local-image">
    </div>

    <div class="form-group">
        <label class="required">Категории</label>
        <select class="selectize-multiple" name="categories[]" multiple="multiple" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @foreach ($product->categories as $prodCat)
                        @if($prodCat->id == $category->id) selected @endif
                    @endforeach
                    >{{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Размеры</label>
        <select class="selectize-multiple" name="sizes[]" multiple="multiple" required>
            @foreach ($sizes as $size)
            <option value="{{ $size->id }}"
                @foreach ($product->sizes as $prodSize)
                    @if($prodSize->id == $size->id) selected @endif
                @endforeach
                >{{ $size->title }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label class="required">Описание</label>
        <textarea class="form-textarea" name="description" rows="5" required>{{ $product->description }}</textarea>
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

{{-- Product images form --}}
<div class="product-images-actions">
    @if(count($product->images))
        <div class="prodct-images-destroy-container">
            <h2>Дополнительные изображения товара</h2>

            @foreach ($product->images as $img)
                <form action="{{ route('images.destroy') }}" method="POST" class="prodct-images-destroy-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $img->id }}">
                    <img class="form-image" src="{{ asset('img/products/additional/' . $img->name) }}">
                    
                    <button><span class="material-icons">close</span></button>
                </form>
            @endforeach
        </div>
    @endif

    <div class="prodct-images-store-container">
        <h2>Добавить дополнительное изображения для товара</h2>

        <form action="{{ route('images.store') }}" method="POST" class="prodct-images-store-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label class="required">Изображение</label>
                <input class="form-input" name="name" type="file" accept=".png, .jpg, .jpeg" required
                data-action="show-image-from-local" data-target="store-product-image">

                <img class="form-image" src="{{ asset('img/dashboard/default-image.png') }}" id="store-product-image">
            </div>

            <div class="form__actions">
                <button class="button button--success" type="submit">
                    <span class="material-icons">done_all</span> Добавить
                </button>
            </div>
        </form>
    </div>
</div>  {{-- Product images form --}}

@include('dashboard.modals.single-destroy', ['destroyRoute' => 'products.destroy', 'itemId' => $product->id ])

@endsection