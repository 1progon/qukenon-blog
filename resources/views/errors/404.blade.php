@extends('layouts.layout')

@section('title', '404 страница ' . request()->path() . ' не найдена')

@section('meta_keys', 'не найдена, страница не найдена, нет такой страницы, ошибочный урл')

@section('canonical', url()->current())

@section('meta_description', '404 ошибка, страница не найдена')

@section('main')
    <div class="container">
        <p>404 ошибка</p>
        <p>Страница <span class="red">{{ request()->path() }}</span> не найдена или перемещена.</p>
        <p>Приносим свои извинения!</p>
    </div>
@endsection
