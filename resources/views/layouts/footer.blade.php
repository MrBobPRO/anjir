<footer class="footer">
    <div class="main-container footer__inner">
        <nav class="footer__nav">
            <ul>
                <li>
                    <a @if($route == 'home') class="active" @endif href="{{ route('home') }}">Главная</a>
                </li>

                <li>
                    <a @if($route == 'researches.index') class="active" @endif href="{{ route('home') }}">Исследования</a>
                </li>

                <li>
                    <a @if($route == 'products.index') class="active" @endif href="{{ route('home') }}">Продукты</a>
                </li>
            </ul>
        </nav>

        <div class="footer__main">
            <p class="copyright">
                © 2021 Belinda Ophthalmology.<br> Все права защищены.
            </p>

            <div class="footer__contacts">
                <p>Следите за нами в<br> социальных сетях</p>
                <div class="footer__socials">
                    <a href="#">
                        @include('svgs.facebook')
                    </a>

                    <a href="#">
                        @include('svgs.instagram')
                    </a>
                </div>

                <form class="footer__mailing" method="POST" action="#">
                    <input type="text" name="email" type="email" placeholder="Подпишитесь на нашу E-mail рассылку" autocomplete="off">
                    <button><span class="material-icons-outlined">email</span></button>
                </form>
            </div>

            <button class="scroll-top">
                <span class="material-icons-outlined scroll-top__icon">keyboard_arrow_up</span>
                <span class="scroll-top__text">Вернутся <br> вверх</span>
            </button>

        </div>
    </div>
</footer>