@extends('layouts.layout')

@section('title', 'Страница категории')

@section('main')
    <div class="posts-list">
        <div class="container">
            @php
                $posts = $category->posts()->paginate();
            @endphp
            <div>{{ $category->title }}</div>
            <div>{{ $category->description }}</div>

            @forelse( $posts as $post)
                @include('includes.post-media')

            @empty
            @endforelse

            {{ $posts->links() }}

        </div>
    </div>
@endsection
