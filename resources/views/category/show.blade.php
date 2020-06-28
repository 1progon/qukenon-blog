@extends('layouts.layout')

@section('title', 'Посты на тему ' . $category->title)

@section('meta_keys', $category->meta_keys)
@section('meta_description', $category->description)
@section('canonical', url('category/' . $category->slug))

@section('main')
    <div class="posts-list">
        <div class="container">
            @php
                $posts = $category->posts()->paginate(10);
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
