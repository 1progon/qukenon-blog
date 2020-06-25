@extends('layouts.admin-layout')


@section('main')

    @forelse(Auth::user()->posts as $post)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->description}}</p>
                <a href="{{route('post.edit', [$post])}}" class="btn btn-primary">Edit</a>
            </div>
        </div>


    @empty
    @endforelse

@endsection
