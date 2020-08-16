@extends('layouts.layout')

@section('title', 'Посты на тему ' . $category->title)

@section('meta_keys', $category->meta_keys)
@section('meta_description', $category->description)
@section('canonical', url('category/' . $category->slug))

@section('main')
    <div class="post-media-list">
        <div class="container">
            @php
                $posts = $category->posts()->latest()->paginate(10);
            @endphp
            <h1 class="title">{{ $category->title }}</h1>
            <div class="description">{{ $category->description }}</div>

            @forelse( $posts as $post)
                @include('includes.post-media')

            @empty
            @endforelse

            {{ $posts->links() }}

        </div>
    </div>
@endsection
