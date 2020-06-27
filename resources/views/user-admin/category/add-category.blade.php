@extends('layouts.admin-layout')

@section('main')

    <div class="container">
        <h2>Создать категорию</h2>

        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="title" class="required">Title</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="input-group">
                <label for="slug" class="required">Slug</label>
                <input type="text" name="slug" id="slug" required>
            </div>

            <div class="input-group">
                <label for="meta-keys">Meta Keys</label>
                <input type="text" name="meta_keys" id="meta-keys">
            </div>

            <div class="input-group">
                <label for="description" class="required">Description</label>
                <input type="text" name="description" id="description" required>
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
                <input type="submit" value="Добавить">
            </div>


        </form>
    </div>
@endsection
