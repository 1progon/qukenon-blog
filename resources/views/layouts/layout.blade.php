<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Qukenon Blog') | Q.Blog</title>

    <meta name="keywords" content="@yield('meta_keys')"/>
    <meta name="description" content="@yield('meta_description')"/>

    <link rel="canonical" href="@yield('canonical')"/>

    <meta name="yandex-verification" content="102b66e49de951d3"/>
    <meta name="google-site-verification" content="aKHzYLwFCQ7xuGQ0GXicAwk_4jeyAmJzR6kQE2YFGic"/>

    <meta name="telderi" content="d71b4958ddfad9245a06b08e0300afb8" />


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="icon" href="{{ asset('images/ico/favicon.ico') }}" type="image/x-icon">


    @yield('head')

</head>
<body>
<div id="bodyAnchor"></div>
<div class="bg-image"></div>

<div class="wrapper">
    <header>
        @include('includes.header')
    </header>

    <main>
        @yield('main')

        {{--To Top Button--}}
        <div class="container">
            <a class="to-top-button" href="#bodyAnchor">
                <img src="{{ asset('images/to-top.svg') }}" alt="На верх кнопка">
            </a></div>
    </main>


    <footer>
        @include('includes.footer')
    </footer>
</div>


@include('includes.counter')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

{{--VUE Production--}}
{{--<script src="https://cdn.jsdelivr.net/npm/vue"></script>--}}

{{--VUE Development--}}
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('js/main-vue-body.js') }}"></script>
<script src="{{ asset('js/scrollToTop.js') }}"></script>

@yield('script')


</body>
</html>
