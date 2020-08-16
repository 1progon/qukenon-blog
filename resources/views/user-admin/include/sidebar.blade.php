<h2>Категории</h2>
<a href="{{ route('category.index')}}">Все категории</a>
<a href="{{ route('category.create')}}">Добавить категорию</a>


<h2>Посты</h2>
<a href="{{ route('post.index')}}">Все посты</a>
<a href="{{ route('post.create')}}">Добавить пост</a>

<h2>Теги</h2>
<a href="{{ route('tag.index')}}">Все теги</a>
<a href="{{ route('tag.create') }}">Добавить тег</a>

<h2>Картинки</h2>
<a href="{{ route('error.images')}}">Не удаленные картинки</a>


{{--<a class=" -action"--}}
{{--   href="{{ route('user.edit', [ Auth::user() ])}}">--}}
{{--    Edit User--}}
{{--</a>--}}
