@extends('layouts.layout')

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
