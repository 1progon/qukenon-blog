<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') | Q.Dashboard</title>

    <meta name="robots" content="noindex, nofollow"/>
    <meta name="l_token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">

    <link rel="icon" href="{{ asset('images/ico/favicon.ico') }}" type="image/x-icon">

    @yield('head')

</head>
<body>

<header>
    <a target="_blank" href="/">На главную сайта | </a>

    <input class="link" type="submit" name="" id="" value="Выйти" form="logout-form">


    <form id="logout-form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
</header>

<div class="wrapper">

    {{--Left Menu list--}}
    <aside class="left-side">
        @include('user-admin.include.sidebar')
    </aside>


    {{--Main right part --}}
    <main class="right-side">
        @yield('main')
    </main>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<!-- версия для разработки, отображает полезные предупреждения в консоли -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('/js/admin-vue-body.js') }}"></script>


@yield('script')


</body>
</html>
