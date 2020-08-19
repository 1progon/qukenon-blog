@extends('layouts.layout')

@section('title', 'Тег ' . $tag->name)

{{--@section('meta_keys', $tag->meta_keys)--}}
@section('meta_description', $tag->description)
@section('canonical', route('tags.front.show', $tag))

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
@endsection

@section('main')
    <div class="post-media-list">
        <div class="container">

            <h1 class="title">{{ $tag->name }}</h1>

            <div class="description">{{ $tag->description }}</div>
            @php
                $posts = $tag->posts()->paginate()
            @endphp


            <a href="{{ route('tags.front.index', ['group'=>'download-minecraft-skins']) }}">Все скины</a>


            @forelse( $posts as $post)
                @if( $tag->group === 'download-minecraft-skins')
                    @include('includes.post-media-with-buttons')
                @else
                    @include('includes.post-media')
                @endif
            @empty
            @endforelse

            {{ $posts->links() }}


            @include('tags.related-tags', [$relatedTags])

        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script>
        $('[data-fancybox="gallery"]').fancybox({
            hideScrollbar: false,
        });
    </script>
@endsection
