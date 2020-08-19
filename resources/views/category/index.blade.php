@extends('layouts.layout')

@section('title', 'Все категории постов')


{{--TODO Hardcoded meta data--}}
@section('meta_keys', 'категории постов, категории сайта, категории игр, игровые категории')
@section('meta_description', 'Категории на сайте для различных постов, материалов, статей на тему игр и игорового мира')

@section('canonical', route('categories.front.index'))

@section('main')

    <div class="categories-list">
        <div class="container">


            @forelse( $categories as $category)
                <a class="card" href="{{ route('categories.front.show', $category) }}">
                    <div class="subtitle">{{ $category->title }}</div>
                    <div class="card-description">{{ $category->description }}</div>
                </a>

            @empty
            @endforelse

            <div class="page-links">
                {{ $categories->links() }}
            </div>

        </div>
    </div>

@endsection
