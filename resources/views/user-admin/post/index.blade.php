@extends('layouts.admin-layout')


@section('main')

    <div class="container">
        <h1>Все посты</h1>
        @forelse(Auth::user()->posts as $post)
            <div>
                <a href="{{ route('post.edit', $post)}}">{{ $post->title }}</a>
            </div>


        @empty
        @endforelse
    </div>


@endsection
