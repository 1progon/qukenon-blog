@extends('layouts.admin-layout')

@section('main')
    <div class="container">
        <h1>Добавить пост</h1>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <label for="category">Категория</label>
                <select name="category_id" id="category" required>
                    @forelse( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @empty
                    @endforelse

                </select>
            </div>


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
                <textarea name="description" id="description" rows="3"></textarea>
            </div>

            <div class="input-group">
                <label for="article">Article</label>
                <textarea name="article" id="article" rows="10"></textarea>
            </div>

            <div class="input-group">
                <label for="image">Image Url (времянка)</label>
                <input type="file" name="images[]" id="image" multiple>
            </div>


            <div class="input-group">
                <input type="submit">
            </div>


        </form>

    </div>

@endsection
