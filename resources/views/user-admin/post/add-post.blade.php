@extends('layouts.admin-layout')

@section('title', 'Добавление новой записи')

@section('main')
    <div class="container">
        <h2>Создать пост</h2>
        <span>Теперь Slug делается сам, можно изменить будет при редактировании</span>




        @if( $noCategories)

            <div class="red">!!! Нет категорий! Добавьте хотя бы одну категорию! <a
                    href="{{ route('category.create') }}">Добавить категорию</a></div>


        @else
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <label for="category" class="required">Категория</label>
                    <select name="category_id" id="category" required>
                        @forelse( $categories as $category)
                            <option value="{{ $category->id }}">id: {{ $category->id }}, {{ $category->title }}</option>
                        @empty
                        @endforelse

                    </select>
                </div>


                <div class="input-group">
                    <label for="title" class="required">Title</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <div class="input-group">
                    <label for="meta-keys">Meta Keys</label>
                    <input type="text" name="meta_keys" id="meta-keys"
                           placeholder="ключ, ещё ключ, другой ключ, и так далее...через зпт">
                </div>

                <div class="input-group">
                    <label for="description" class="required">Description</label>
                    <textarea name="description" id="description" rows="3" required></textarea>
                </div>

                <div class="input-group">
                    <label for="article" class="required">Article</label>
                    <textarea name="article" id="article" rows="10"></textarea>
                </div>

                <div class="input-group">
                    <label for="image" class="required">Images</label>
                    <input type="file" name="images[]" id="image" multiple required>
                </div>


                <div class="input-group">
                    <input type="submit" value="Добавить пост">
                </div>


            </form>


        @endif

    </div>

@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/it9flfkne9lbb0q483danxyozutkhka063ekm0zrald7ty2w/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{ asset('js/admin-tinymce.js') }}"></script>
@endsection
