@extends('layouts.layout')

@section('title', $post->title)

@section('meta_keys', $post->meta_keys)
@section('meta_description', $post->description)
@section('canonical', url($post->slug))

@section('main')

    <div class="post">
        <div class="container">

            <h1 class="title">{{ $post->title }}</h1>

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
                    <div class="thumbnail">
                        <img src="{{ asset('storage/' . $firstImage->folder . '/'. $firstImage->filename) }}" alt="">
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
    </div>
@endsection





