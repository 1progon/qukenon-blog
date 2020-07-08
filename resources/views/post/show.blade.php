@extends('layouts.layout')

@section('title', $post->title)

@section('meta_keys', $post->meta_keys)
@section('meta_description', $post->description)
@section('canonical', route('post.front.show', [$post, $post->id]))

@section('main')

    <div class="post container">

        <h1 class="title">{{ $post->title }}</h1>

        {{--Only for auth user--}}
        {{--TODO Authorize edit--}}
        <div>
            @auth
                <a target="_blank" href="{{ route('post.edit', $post) }}">Edit</a>
            @endauth
        </div>

        {{--Meta--}}
        <div class="meta">
            <div>Опубликовано: {{ $post->created_at }}</div>
            @if( $post->created_at !== $post->updated_at)
                <div>Обновлено: {{ $post->updated_at }}</div>
            @endif
            <div>Автор: {{ $post->user->name }}</div>


        </div>


        <div class="description">{{ $post->description }}</div>

        @if( isset($firstImage))
            @php

                $thumb = \App\Http\Controllers\PostsController::THUMB['smallest']

            @endphp

            <div class="images-block">

                @php
                    $imSize = getimagesize(asset('storage/' . $firstImage->folder . '/'.
                    $firstImage->filename));

                @endphp


                <div class="thumbnail @if( $imSize[0] < 720)thumbnail-float @endif">

                    <img src="{{ asset('storage/' . $firstImage->folder . '/'. $firstImage->filename) }}"
                         alt="изображение для записи {{$post->title}}" width="{{ $imSize[0] }}" height="{{
                             $imSize[1] }}">
                </div>

                <div class="small-images">
                    @forelse($images as $image)
                        <a data-fancybox="gallery"
                           href="{{ asset('storage/' . $image->folder . '/'. $image->filename) }}">
                            <img src="{{ asset('storage/' . $image->folder . '/'. $thumb['str'] . '_' .
                                $image->filename) }}"
                                 width="{{ $thumb['w'] }}"
                                 height="{{ $thumb['h'] }}"
                                 alt="">
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        @endif


        <article>


            {{--TODO
            Need Sanitize data purifer--}}

            {!! $post->article !!}
            {{--                {{ $post->article }}--}}
        </article>


    </div>

    <div class="related-posts container">
        <h3>Другие записи</h3>

        <div class="post-media-card">
            @php
                $related = true;
            @endphp


            @forelse( $relatedPosts as $post)
                @include('includes.post-media-card', compact($related))
            @empty
            @endforelse
        </div>
    </div>
@endsection





