<div class="main-modal policy-modal" id="policy-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-background" data-action="hide-modal" data-target-id="policy-modal"></div>
    <div class="modal-dialog gradient-bg">
        <img src="{{ asset('img/main/close.png') }}" class="modal-close-btn" data-action="hide-modal" data-target-id="policy-modal">
        <div class="modal-content">
            <h2 class="modal-title">Пользовательское соглашение</h2>
            <div class="policy-modal__text">{!! App\Models\Option::where('key', 'privacy-policy')->first()->value !!}</div>
        </div>
    </div>
</div>