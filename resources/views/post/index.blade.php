@extends('layouts.layout')

@section('main')


    <div class="post-media-list">
        <div class="container">
            <h3 class="title">Все материалы</h3>
            @forelse( $posts as $post)
                @include('includes.post-media')

            @empty
            @endforelse

            {{ $posts->links() }}
        </div>


    </div>

@endsection
