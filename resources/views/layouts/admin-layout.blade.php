<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    @yield('head')

</head>
<body>

<div class="container row">

    {{--Left Menu list--}}
    <aside class="col-12 col-sm-3">
        @include('includes.admin.sidebar')
    </aside>


    {{--Main right part --}}
    <main class="col-12 col-sm">
        @yield('main')
    </main>
</div>


</body>
</html>
