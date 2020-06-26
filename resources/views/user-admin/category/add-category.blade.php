@extends('layouts.admin-layout')

@section('main')

    <div class="container">
        <h1>Создать категорию</h1>

        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
            </div>

            <div class="input-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug">
            </div>

            <div class="input-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </div>

            <div class="input-group">
                <label for="main-bar">Добавить в шапку</label>
                <input type="checkbox" name="main_bar" id="main-bar" value="1">
            </div>

            <div class="input-group">
                <label for="image">Добавить картинку</label>
                <input type="file" name="image" id="image">
            </div>


            <div class="input-group">
                <label for="image"></label>
                <input type="submit" name="image" id="image">
            </div>


        </form>
    </div>
@endsection
