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
                    <span>Создано</span>
                    <span>Изменено</span>
                    <span>Удалить</span>

                </div>

                @forelse(Auth::user()->posts as $post)
                    <div class="card">
                        <span class="post-title">{{ $post->id }}</span>
                        <a href="{{ route('post.edit', $post)}}">Edit</a>

                        <span>{{ $post->title }}</span>
                        <span>{{ $post->category->title}}</span>
                        <span>{{ $post->created_at}}</span>
                        <span>{{ $post->updated_at}}</span>
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')


                            <div class="input-group">
                                <input id="delete-post-btn-{{ $post->id }}" type="submit" name="" value="Удалить">
                            </div>
                        </form>

                    </div>

                @empty
                @endforelse
            </div>
        </div>
    </div>


@endsection
