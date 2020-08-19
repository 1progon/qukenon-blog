@extends('layouts.layout')

@section('title', 'Все записи и посты Ютубера Кукенон из мира игр')

@section('meta_keys', 'все записи об играх, посты об играх, новости из мира игр список, где почитать про игры,
информация об играх')
@section('meta_description', 'Все записи, которые были написаны Ютубером Кукенон об играх и из мира игр. Интересные и
 полезные. Сделано с душой')

@section('canonical', route('posts.front.index'))

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
