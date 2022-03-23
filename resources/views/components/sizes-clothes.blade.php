<form class="product-card__form" action="#">
    <div>
        <input type="radio" name="size" value="XS" id="XS{{ $product->id }}" checked>
        <label for="XS{{ $product->id }}">XS</label>
    </div>

    <div>
        <input type="radio" name="size" value="S" id="S{{ $product->id }}">
        <label for="S{{ $product->id }}">S</label>
    </div>

    <div>
        <input type="radio" name="size" value="M" id="M{{ $product->id }}">
        <label for="M{{ $product->id }}">M</label>
    </div>

    <div>
        <input type="radio" name="size" value="L" id="L{{ $product->id }}">
        <label for="L{{ $product->id }}">L</label>
    </div>

    <div>
        <input type="radio" name="size" value="XL" id="XL{{ $product->id }}">
        <label for="XL{{ $product->id }}">XL</label>
    </div>

    <div>
        <input type="radio" name="size" value="XXL" id="XXL{{ $product->id }}">
        <label for="XXL{{ $product->id }}">XXL</label>
    </div>
</form>