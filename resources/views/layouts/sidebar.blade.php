<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('./img/1c-logo.png') }}">
    </div>

    @guest()
        <div class="vhod">
            <div class="login">
                <div>
                    <img src="{{ asset('./img/user2.png') }}">
                    <span>Личный кабинет</span>
                </div>
                <div class="vhod__text">
                    <b>Демонстративный доступ</b> Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает <a href="">сосредоточиться</a>. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение
                    шаблона
                </div>
                <div class="vhod-btns">
                    <a href="{{ route('user.loginPage') }}" class="btn btn-primary">Вход</a>
                    <a href="{{ route('user.registrationPage') }}" class="btn btn-link">Регистрация</a>
                </div>
            </div>
        </div>
    @endguest
    @auth()
        <div class="profile-sidebar">
            <div class="profile-sidebar__title">
                <img src="{{ asset('./img/user2.png') }}">
                Личный кабинет
            </div>
            <div class="profile-sidebar-log">
                <div>
                    <div>{{  auth()->user()->name }}</div>
                    <div>{{  auth()->user()->email }}</div>
                    @if(auth()->user()->isActiveStatus())
                        <div>Доступ: до {{ auth()->user()->getDateTo()->format('d.m.Y H:i') }} </div>
                    @else
                        <div>Доступ: нет </div>
                    @endif
                </div>
            </div>
            <ul>
                <li class="active">
                    <a href="{{ route('user.personalPage') }}">
                        <i class="fas fa-user"></i>
                        Профиль
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.favoritesPage') }}">
                        <i class="far fa-plus-square"></i>
                        Избранное
                    </a>
                </li>
                <li>
                    <a href="{{ route('personalCalendar') }}">
                        <i class="far fa-calendar-alt"></i>
                        Личный Календарь
                    </a>
                </li>
            </ul>
            <form action="{{ route('user.logout') }}">
                <button class="btn btn-primary">Выход</button>
            </form>
        </div>
    @endauth

    <nav class="navbar">
        <ul class="sidebar__menu navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i>Главная</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('normativeBase') }}"><i class="fas fa-database"></i>Нормативная база</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('taxSystem') }}"><i class="fas fa-donate"></i>Налоговая система</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('consultations') }}"><i class="fas fa-balance-scale-left"></i>Консультации и аналитика</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports') }}"><i class="fas fa-file-invoice"></i>Отчетность</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('blanks') }}"><i class="fas fa-receipt"></i>Формы и бланки</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('handbook') }}"><i class="fas fa-book"></i>Справочники</a></li>
        </ul>
        <ul class="sidebar__menu navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('news.list') }}"><i class="far fa-newspaper"></i>Новости</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('publishedOnSite') }}"><i class="fab fa-leanpub"></i>Опубликовано на сайте</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('accountantCalendar') }}"><i class="far fa-calendar-alt"></i>Календарь бухгалтера</a></li>
        </ul>
        <ul class="sidebar__menu navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('termsOfUse') }}"><i class="fas fa-file-signature"></i>Пользовательськое соглашение</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contractForServices') }}"><i class="far fa-file-word"></i>Договор на оказание услуг</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('publicAgreement') }}"><i class="fas fa-file-invoice"></i>Публичный договор</a></li>
        </ul>
    </nav>
</div>
