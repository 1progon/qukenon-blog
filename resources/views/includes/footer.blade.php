@yield('footer')

<div class="container">
    <div>
        <div><a href="/about">О нас</a></div>
        <div><a href="/contact">Контакты</a></div>
    </div>


    <div>
        @guest
            <div><a href="/register">Регистрация</a></div>
            <div><a href="/login">Вход</a></div>
        @endguest
    </div>

</div>
