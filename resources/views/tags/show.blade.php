@extends('layouts.layout')

@section('title', 'Тег ' . $tag->name)

{{--@section('meta_keys', $tag->meta_keys)--}}
@section('meta_description', $tag->description)
@section('canonical', url('tag/' . $tag->slug))

@section('main')
    <div class="post-media-list">
        <div class="container">

            <h1 class="title">{{ $tag->name }}</h1>

            <div class="description">{{ $tag->description }}</div>
            @php
                $posts = $tag->posts()->paginate();
            @endphp



            @forelse( $posts as $post)
                @if( $tag->group === 'minecraft-skins')
                    @include('includes.post-media-with-buttons')
                @else
                    @include('includes.post-media')
                @endif
            @empty
            @endforelse

            {{ $posts->links() }}

        </div>
    </div>

@endsection
