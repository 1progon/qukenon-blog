@extends('layouts.admin-layout')

@section('title', 'Редактирование ' . $post->id . ', ' . $post->title)

@section('main')
    <div class="container">
        <h2>Редактировать пост</h2>
        <div class="post-meta">
            <div class="post-title">{{ $post->title }}, id: {{ $post->id }}</div>
            <a class="link" target="_blank" href="{{ route('post.front.show', [$post, $post->id]) }}">Открыть</a>
        </div>

        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="input-group">
                <label for="category" class="required">Категория</label>
                <select name="category_id" id="category" required>
                    @forelse( $categories as $category)
                        <option @if( $post->category->id == $category->id) selected @endif
                        value="{{ $category->id}}">{{ $category->title }}</option>
                    @empty
                    @endforelse

                </select>
            </div>


            @if( $tags->count())
                <div class="input-group">
                    <label for="select-tag-group">Фильтр тегов</label>
                    <input @keyup="filterGroups" type="text" name="" id="select-tag-group" class="select-tag-group">
                </div>

            @endif

            <div class="input-group tags-list">
                <label>Теги</label>
                <div class="f-column">

                    @forelse( $tags as $tag )
                        <div>
                            <input type="checkbox"
                                   @if( in_array($tag->id, $post->tags()->allRelatedIds()->toArray() )) checked
                                   @endif
                                   name="tags[]"
                                   id="tag_{{ $tag->id }}"
                                   value="{{ $tag->id }}">
                            <label for="tag_{{ $tag->id }}">
                                {{ $tag->name }}
                                <span class="group-name">(гр.: {{ $tag->group }})</span>
                            </label>
                        </div>
                    @empty
                        <span>Нет тегов, нужно добавить теги</span> - <a href="{{ route('tag.create') }}">Добавить</a>
                    @endforelse
                </div>
            </div>


            <div class="input-group">
                <label for="title" class="required">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" required>
            </div>

            <div class="input-group">
                <label for="slug" class="required">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $post->slug }}" required>
            </div>

            <div class="input-group">
                <label for="meta-keys">Meta Keys</label>
                <input type="text" name="meta_keys" id="meta-keys" value="{{ $post->meta_keys }}">
            </div>

            <div class="input-group">
                <label for="description" class="required">Description</label>
                <textarea name="description" id="description" rows="3" required>{{ $post->description }}</textarea>
            </div>

            <div class="input-group">
                <label for="article" class="required">Article</label>
                <textarea name="article" id="article" rows="10">{{ $post->article }}</textarea>
            </div>

            <div class="input-group">
                <label for="">Картинки</label>
                <div class="old-images">
                    @php
                        $thumb = \App\Http\Controllers\Post\PostsController::THUMB['smallest']
                    @endphp

                    @forelse( $post->images as $image)
                        @php
                            $imagePath = $image->folder . '/' . $thumb['str'] .'_' . $image->filename
                        @endphp

                        <div class="block">
                            <div class="image">
                                <a data-fancybox="gallery" href="{{ asset('storage/' . $image->folder . '/' .
                                $image->filename) }}">
                                    <img
                                        src="{{ asset('storage/' . $imagePath )}}"
                                        width="{{ $thumb['w'] }}"
                                        height="{{ $thumb['h'] }}"
                                        alt="image">
                                </a>
                            </div>


                            <div class="remove-block">
                                <label for="remove-image-{{ $image->id }}">Удалить</label>
                                <input type="checkbox" name="remove_images[]" id="remove-image-{{ $image->id }}"
                                       value="{{ $image->id }}">
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

            <div class="input-group">
                <label for="image">Images</label>
                <input type="file" name="images[]" id="image" multiple>
            </div>


            <div class="input-group">
                <input type="submit" value="Обновить">
            </div>


        </form>

    </div>

@endsection

@section('script')
    <script src="https://cdn.tiny.cloud/1/it9flfkne9lbb0q483danxyozutkhka063ekm0zrald7ty2w/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{ asset('js/admin-tinymce.js') }}"></script>
@endsection
