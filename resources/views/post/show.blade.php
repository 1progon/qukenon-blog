@extends('layouts.layout')

@section('title', 'Show post Page')

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
                <div class="thumbnail">
                    <img src="{{ asset('storage/' . $firstImage->filepath) }}" alt="">
                </div>

                <div class="small-images">
                    @forelse($images as $image)
                        <a href="{{ asset('storage/' . $image->filepath) }}">
                            <img src="{{ asset('storage/' . $image->filepath) }}" width="80" height="80" alt="">
                        </a>
                    @empty
                    @endforelse
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





