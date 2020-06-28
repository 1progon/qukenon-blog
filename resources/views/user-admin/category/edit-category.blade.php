@extends('layouts.admin-layout')

@section('main')

    <div class="container">
        <h2>Редактировать категорию,
            <span>{{ $category->title }} {{ $category->id }}</span>
        </h2>

        <form action="{{ route('category.update', $category) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="input-group">
                <label for="title" class="required">Title</label>
                <input type="text" name="title" id="title" required value="{{ $category->title }}">
            </div>

            <div class="input-group">
                <label for="slug" class="required">Slug</label>
                <input type="text" name="slug" id="slug" required value="{{ $category->slug }}">
            </div>

            <div class="input-group">
                <label for="meta-keys">Meta Keys</label>
                <input type="text" name="meta_keys" id="meta-keys" value="{{ $category->meta_keys }}">
            </div>

            <div class="input-group">
                <label for="description" class="required">Description</label>
                <input type="text" name="description" id="description" required value="{{ $category->description }}">
            </div>

            <div class="input-group">
                <label for="main-bar">Добавить в шапку</label>
                <input {{ $category->main_bar == 1 ? 'checked="checked"' : '' }} type="checkbox" name="main_bar"
                       id="main-bar"
                       value="1">
            </div>

            <div class="input-group">
                <label for="image">Добавить картинку</label>
                <input type="file" name="image" id="image">
            </div>


            <div class="input-group">
                <input type="submit" value="Обновить">
            </div>


        </form>
    </div>
@endsection
