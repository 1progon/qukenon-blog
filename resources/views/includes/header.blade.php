@yield('header')


{{--Top Bar--}}
<div class="top-bar">
    <div class="container">
        <div class="parts">
            <div class="left">
                <a href="{{ route('page.about') }}">О нас</a>
                <a href="{{ route('page.contact') }}">Контакты</a>
            </div>
            <div class="right">
                {{--                @guest--}}
                {{--                    <a href="{{ route('login.form') }}">Войти</a>--}}
                {{--                @endguest--}}

                @auth
                    <a class="link" href="{{ route('dashboard') }}">Аккаунт</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input class="link" type="submit" name="" id="" value="Выйти">
                    </form>
                @endauth


            </div>
        </div>
    </div>

</div>


{{--Main Bar--}}
<div class="main-bar">
    <div class="container">
        <div class="parts">
            <a class="logo" href="/">
                <img src="{{ asset('images/logo/logo-subtext.svg') }}" alt="">
            </a>
            <nav class="links" v-bind:class="{ 'open': showMobileMenu }">


                @php
                    $categories = \App\Category::where('main_bar', '=', 1)->get();
                @endphp

                @for($i = 0; $i < 6; $i++)

                    @if( !isset($categories[$i]))
                        @break
                    @endif
                    <div>
                        <a href="/category/{{ $categories[$i]->slug }}">
                            <span>{{ $categories[$i]->title }}</span>
                        </a>
                    </div>

                @endfor

                <div class="more-categories">
                    <a href="/category">
                        <span>Ещё</span>
                        <img src="{{ asset('images/arrow-right-white.svg')}}" width="16" height="16" alt="">
                    </a>
                </div>

                {{--Close mobile menu--}}
                <div v-on:click="showMobileMenu = !showMobileMenu" class="close-mobile-menu">
                    <img src="{{ asset('images/close.svg') }}" alt="">
                </div>
            </nav>

            <div v-on:click="showMobileMenu = !showMobileMenu" class="mobile-menu-button">
                <img src="{{ asset('images/menu-white.svg') }}" alt="">
            </div>


            {{--<div class="register">--}}
            {{--<a href="/register" class="btn">Регистрация</a>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
