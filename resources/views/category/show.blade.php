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
            <div class="title">{{ $category->title }}</div>
            <div class="description">{{ $category->description }}</div>

            @forelse( $posts as $post)
                @include('includes.post-media')

            @empty
            @endforelse

            {{ $posts->links() }}

        </div>
    </div>
@endsection
