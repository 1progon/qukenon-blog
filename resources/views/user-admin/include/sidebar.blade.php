<h2>Категории</h2>
<a href="{{ route('categories.index')}}">Все категории</a>
<a href="{{ route('categories.create')}}">Добавить категорию</a>


<h2>Посты</h2>
<a href="{{ route('posts.index')}}">Все посты</a>
<a href="{{ route('posts.create')}}">Добавить пост</a>

<h2>Теги</h2>
<a href="{{ route('tags.index')}}">Все теги</a>
<a href="{{ route('tags.create') }}">Добавить тег</a>

<h2>Картинки</h2>
<a href="{{ route('error.images')}}">Не удаленные картинки</a>

<h2>Пользователь</h2>
<a href="{{ route('users.edit', auth()->id()) }}">Редактировать</a>


{{--<a class=" -action"--}}
{{--   href="{{ route('user.edit', [ Auth::user() ])}}">--}}
{{--    Edit User--}}
{{--</a>--}}
