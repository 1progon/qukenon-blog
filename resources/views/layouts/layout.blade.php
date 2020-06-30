<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Q.Blog</title>

    <meta name="keywords" content="@yield('meta_keys')"/>
    <meta name="description" content="@yield('meta_description')"/>

    <link rel="canonical" href="@yield('canonical')"/>


    <link rel="stylesheet" href="/css/app.css">

    @yield('head')

</head>
<body>
<div class="bg-image"></div>

<div class="wrapper">
    <header>
        @include('includes.header')
    </header>

    <main>
        @yield('main')
    </main>


    <footer>
        @include('includes.footer')
    </footer>
</div>


@include('includes.counter')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>


<!-- версия для разработки, отображает полезные предупреждения в консоли -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('js/main-vue-body.js') }}"></script>


</body>
</html>
