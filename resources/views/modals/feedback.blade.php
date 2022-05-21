<div class="main-modal feedback-modal" id="feedback-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-background" data-action="hide-modal" data-target-id="feedback-modal"></div>
    <div class="modal-dialog gradient-bg">
        <div class="modal-content">
            <img src="{{ asset('img/main/close.png') }}" class="modal-close-btn" data-action="hide-modal" data-target-id="feedback-modal">
            <img src="{{ asset('img/main/sliced-anjir.png') }}" class="modal-content__background">
            <h2 class="modal-title">Заказать звонок</h2>
            <img class="modal-image" src="{{ asset('img/main/feedback.png') }}" alt="feedback">

            <form action="{{ route('feedback.store') }}" method="POST" class="modal-form">
                @csrf
                <input type="text" name="name" placeholder="Ф.И.О" required>
                <input type="text" name="phone" placeholder="номер телефона" required>
                <button>заказать</button>
            </form>
        </div>
    </div>
</div>