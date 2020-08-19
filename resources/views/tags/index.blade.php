@extends('layouts.layout')

@section('title', 'Все теги записей')


{{--TODO Fill meta data--}}
@section('meta_keys', 'все теги записей по играм, теги на различные темы, теги про игры, теги об играх, выбор игр,
теги по скинам для игр')
@section('meta_description', 'На этой странице Вы сможете найти различным тематические теги к записям и скинам на
нашем сайте')
@section('canonical', route('tags.front.index'))

@section('main')

    <div class="categories-list">
        <div class="container">


            @forelse( $tags as $tag)
                <a class="card" href="{{ route('tags.front.show', $tag) }}">
                    <div class="subtitle">{{ $tag->name }}</div>
                    <div class="card-description">{{ $tag->description }}</div>
                </a>

            @empty
            @endforelse

            <div class="page-links">
                {{ $tags->links() }}
            </div>

        </div>
    </div>

@endsection
