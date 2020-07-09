@extends('layouts.layout')

@section('title', '404 страница ' . request()->path() . ' не найдена')

@section('meta_keys', 'не найдена, страница не найдена, нет такой страницы, ошибочный урл')
@section('meta_description', '404 ошибка, страница не найдена')

@section('canonical', url()->current() . '/' . request()->getQueryString())


@section('main')
    <div class="error-page container">
        <p class="error-404-code">404 ошибка</p>
        <p>Страница <span class="red">{{ rtrim(request()->path(), '/') . ' ' . request()->getQueryString() }}</span> не
            найдена или перемещена.</p>
        <p>Приносим свои извинения!</p>
    </div>
@endsection
