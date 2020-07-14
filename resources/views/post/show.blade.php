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

                $thumb = \App\Http\Controllers\PostsController::THUMB['smallest'];

                $imSize = getimagesize(asset('storage/' . $firstImage->folder . '/'. $firstImage->filename));

            @endphp

            <div class="images-block @if( $imSize[0] < 720) images-block-float @endif ">

                <div class="thumbnail">

                    <img src="{{ asset('storage/' . $firstImage->folder . '/'. $firstImage->filename) }}"
                         alt="изображение для записи {{ $post->title}}" width="{{ $imSize[0] }}" height="{{
                             $imSize[1] }}">
                </div>

                <div class="small-images">
                    @forelse( $images as $image)
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

        <div class="adv-before-article">
            @include('includes.adv-header')
        </div>

        <article>

            {{--TODO
            Need Sanitize data purifer--}}

            {{--Adsense before Post--}}
            <div class="adv-ads">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- qukenon 336-280 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-8481515375748477"
                     data-ad-slot="3239673640"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>


            {!! $post->article !!}
            {{--{{ $post->article }}--}}

            {{--Adsense after Post - netboard--}}
            <div class="adv-ads-after-article">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- qukenon netboard 580-400 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:580px;height:400px"
                     data-ad-client="ca-pub-8481515375748477"
                     data-ad-slot="4228008608"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>

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





