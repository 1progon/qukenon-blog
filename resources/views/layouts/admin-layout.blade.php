<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>


    <link rel="stylesheet" href="/css/admin.css">

    @yield('head')

</head>
<body>

<header>
    <a href="/">На главную сайта</a>

    <input class="link" type="submit" name="" id="" value="Выйти" form="logout-form">


    <form id="logout-form" action="{{ route('logout') }}" method="post">
        @csrf
    </form>
</header>

<div class="wrapper">

    {{--Left Menu list--}}
    <aside class="left-side">
        @include('includes.admin.sidebar')
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
<script src="/js/admin-vue-body.js"></script>


@yield('script')


</body>
</html>
