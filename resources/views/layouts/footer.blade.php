<footer class="footer">
    {{-- Footer Top start --}}
    <div class="main-container footer__top">
        <div class="footer__block">
            <a class="logo footer__logo" href="{{ route('home') }}">
                <img src="{{ asset('img/main/logo.png') }}" alt="Anjir logo">
            </a>
            <p>Магазин одежды со вкусом стиля</p>
        </div>

        <div class="footer__block">
            <ul class="footer__links">
                <li><a href="{{ route('about-us') }}">О нас</a></li>
                <li><a href="javascript:void(0)" data-action="show-modal" data-target-id="policy-modal">Пользовательское соглашение</a></li>
            </ul>
        </div>

        <div class="footer__block">
            <p>Ваши пожелания</p>
            <ul class="footer__links">
                <li><a href="tel:+992404900009">+992 404900009</a></li>
            </ul>
        </div>

        <div class="footer__block">
            <p>Мы в соц.медиа</p>
            <ul class="footer__socials">
                <li><a href="https://www.facebook.com/Anjir.store" target="_blank">@include('svgs.facebook')</a></li>
                <li><a href="https://www.instagram.com/anjir.tj/" target="_blank">@include('svgs.instagram')</a></li>
            </ul>
            <p>Наши контакты</p>
            <ul class="footer__links">
                <li><a href="tel:992404900009">+992 404900009</a></li>
            </ul>
        </div>
    </div> {{-- Footer Top end --}}

    {{-- Footer Copyright start --}}
    <div class="footer__copyright">
        <div class="footer__copyright-border"></div>
        <div class="main-container footer__copyright-inner">
            <p>© Anjir {{ date('Y') }}. Все права защищены.</p>
        </div>
    </div> {{-- Footer Copyright end --}}
</footer>