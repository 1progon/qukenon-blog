@extends('layouts.layout')

@section('title', 'Все категории постов')


{{--TODO Hardcoded meta data--}}
@section('meta_keys', 'категории постов, категории сайта, категории игр, игровые категории')
@section('meta_description', 'Категории на сайте для различных постов, материалов, статей на тему игр и игорового мира')

{{--TODO Hardcoded category sublink--}}
@section('canonical', url('category'))

@section('main')

    <div class="categories-list">
        <div class="container">


            @forelse( $categories as $category)
                <a class="card" href="/category/{{ $category->slug }}">
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
