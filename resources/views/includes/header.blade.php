@yield('header')


{{--Top Bar--}}
<div class="top-bar">
    <div class="container">
        <div class="parts">
            <div class="left">
                <a href="/about">О нас</a>
                <a href="/contact">Контакты</a>
            </div>
            <div class="right">
                <a href="/login">Войти</a>
            </div>
        </div>
    </div>

</div>


{{--Main Bar--}}
<div class="main-bar">
    <div class="container">
        <div class="parts">
            <a href="/">
                <div class="logo">LOGO</div>
            </a>
            <nav class="links">
                @php
                    $categories = \App\Category::where('main_bar', '=', 1)->get();
                @endphp

                @for($i = 0; $i < 5; $i++)

                    @if( !isset($categories[$i]))
                        @break
                    @endif
                    <div>
                        <a href="/category/{{ $categories[$i]->slug }}">
                            <span>{{ $categories[$i]->title }}</span>
                        </a>
                    </div>

                @endfor

                {{--                @forelse(  as $category)--}}
                {{--                    <div>--}}
                {{--                        <a href="/category/{{ $category->slug }}">{{ $category->title }}</a>--}}
                {{--                    </div>--}}
                {{--                @empty--}}
                {{--                @endforelse--}}
                <div class="more-categories">
                    <a href="/category">
                        <span>Ещё</span>
                        <img src="{{ asset('images/arrow-right-white.svg')}}" width="20" alt="">
                    </a>
                </div>
            </nav>
            <div class="register">
                {{--<a href="/register" class="btn">Регистрация</a>--}}
            </div>
        </div>
    </div>
</div>
