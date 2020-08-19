@extends('layouts.admin-layout')

@section('title', 'Все Ваши записи')


@section('main')

    <div class="admin-posts-list">
        <div class="container">
            <h1>Все посты</h1>
            <table class="posts">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Открыть</th>
                    <th>Редактировать</th>
                    <th>Категория</th>
                    <th>Кат ID</th>
                    <th>Создано</th>
                    <th>Изменено</th>
                    <th>Удалить</th>
                </tr>

                </thead>

                <tbody>
                @forelse( $posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>

                        <td>
                            <a target="_blank" href="{{ route('posts.front.show', [$post, $post->id]) }}">Открыть</a>
                        </td>
                        <td>
                            <a href="{{ route('posts.edit', [$post, $post->id])}}">Редактировать</a>
                        </td>


                        <td>{{ $post->category->title}}</td>
                        <td>{{ $post->category->id}}</td>
                        <td>{{ $post->created_at}}</td>
                        <td>{{ $post->updated_at}}</td>
                        <td>
                            <form id="form-{{ $post->id }}"
                                  action="{{ route('posts.destroy', $post) }}"
                                  v-on:submit.prevent="showConfirmNotify($event)"
                                  method="post">
                                @csrf
                                @method('DELETE')

                                <div id="notify-{{ $post->id }}" style="display: none" class="notify">

                                    <p class="text-row">Точно удалить пост?? Будут также удалены все картинки и
                                        тумбы, а
                                        еще комменты, если они есть...</p>


                                    <div class="action-buttons">
                                        <span v-on:click="removePostOrCategory({{ $post->id }})" class="remove
                                        btn-outline">Удалить</span>

                                        <span v-on:click="hideConfirmNotify({{ $post->id }})"
                                              class="decline btn">Отменить</span>
                                    </div>

                                    <div class="response-message">@{{ message }}</div>


                                </div>


                                <input class="link" id="delete-post-btn-{{ $post->id }}" type="submit" name=""
                                       value="Удалить">
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>

                {{ $posts->links() }}
            </table>
        </div>
    </div>


@endsection
