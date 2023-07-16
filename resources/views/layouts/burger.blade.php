<div class="mob-top">
    <div class="burger" id="burger">
        <i class="fas fa-bars burger-open"></i>
        <i class="fas fa-times burger-close"></i>
    </div>
    <div class="mob-top__phone"><a href="tel:0713301683">071 330 16 83</a></div>

    <div class="login">
        @guest()
            <a class="" href="{{ route('user.loginPage') }}">
                <span>Вход</span>
                <img src="{{ asset("./img/user.png") }}">
            </a>
        @endguest
        @auth()
            <a class="" href="#">
                <span>Выход</span>
                <img src="{{ asset("./img/user.png") }}">
            </a>
        @endauth
    </div>

</div>
