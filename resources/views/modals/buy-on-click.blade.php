<div class="main-modal buy-on-click-modal" id="buy-on-click-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-background" data-action="hide-modal" data-target-id="buy-on-click-modal"></div>
    <div class="gradient-bg modal-dialog">
        <div class="modal-content">
            <img src="{{ asset('img/main/sliced-anjir.png') }}" class="modal-content__background">
            <h2 class="modal-title">Купить в один клик</h2>
            <img class="modal-image" id="buy-on-click-modal-image" src="{{ asset('img/main/feedback.png') }}">

            <form action="{{ route('orders.buy-on-click') }}" method="POST" class="modal-form buy-on-click-form">
                @csrf

                <div class="product-card__sizes buy-on-click-sizes" id="buy-on-click-sizes"></div>

                <div class="counter">
                    <button type="button" class="decrement-amount">–</button>
                    <input type="text" name="amount" value="1" class="only-numbers" id="buy-on-click-modal-amount" required>
                    <button type="button" class="increment-amount">+</button>
                </div>

                <input type="text" name="name" placeholder="Ф.И.О" required>
                <input type="text" name="phone" placeholder="номер телефона" required>
                <button>заказать</button>
            </form>
        </div>
    </div>
</div>