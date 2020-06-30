@yield('footer')

<div class="container">
    <div>
        <div><a href="{{ route('page.about') }}">О нас</a></div>
        <div><a href="{{ route('page.contact') }}">Контакты</a></div>

    </div>


    <div>
        @guest
            {{--<div><a href="{{ route('register.form') }}">Регистрация</a></div>--}}
            {{--<div><a href="{{ route('login.form') }}">Вход</a></div>--}}
        @endguest

        @auth
            <div><a href="{{ route('dashboard') }}">Аккаунт</a></div>
            <div><a href="/logout">Выйти</a></div>
        @endauth
    </div>

    <div>
        <div><a href="/post">Все записи</a></div>
        <div><a href="/category">Все категории</a></div>
    </div>

</div>
