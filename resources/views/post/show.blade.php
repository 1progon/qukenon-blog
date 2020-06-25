@extends('layouts.layout')

@section('title', 'Show post Page')

@section('main')

    <div class="post">
        {{ $post->title }}
    </div>
@endsection
