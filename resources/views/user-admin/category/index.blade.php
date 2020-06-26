@extends('layouts.admin-layout')

@section('main')
    <div class="container">
        <h1>Все категории</h1>
        @forelse( $categories as $category)
            <div>
                <a href="{{ route('category.edit', $category) }}">
                    {{ $category->title }}
                </a>
            </div>
        @empty
        @endforelse
    </div>
@endsection
