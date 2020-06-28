@extends('layouts.admin-layout')


@section('main')

    <div class="admin-posts-list">
        <div class="container">
            <h1>Все посты</h1>
            <div class="posts">
                <div class="card">
                    <span>Id</span>
                    <span>Edit</span>
                    <span>Title</span>
                    <span>Категория</span>
                    <span>Кат ID</span>
                    <span>Создано</span>
                    <span>Изменено</span>
                    <span class="remove-col">Удалить</span>

                </div>

                @forelse( $posts as $post)
                    <div class="card">
                        <span class="post-title">{{ $post->id }}</span>
                        <a href="{{ route('post.edit', $post)}}">Edit</a>

                        <span>{{ $post->title }}</span>
                        <span>{{ $post->category->title}}</span>
                        <span>{{ $post->category->id}}</span>
                        <span>{{ $post->created_at}}</span>
                        <span>{{ $post->updated_at}}</span>
                        <div class="remove-col">
                            <form id="form-{{ $post->id }}"
                                  action="{{ route('post.destroy', $post) }}"
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
                        </div>

                    </div>

                @empty
                @endforelse

                {{ $posts->links() }}
            </div>
        </div>
    </div>


@endsection
