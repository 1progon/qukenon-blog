@extends('layouts.admin-layout')


@section('main')
    <div class="container">

        <h2>Редактировать тег</h2>

        <form action="{{ route('tags.update', $tag) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="input-group">
                <label for="name">Название</label>
                <input type="text" name="name" id="name" value="{{ $tag->name }}" required>
            </div>
            @error('name')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <div class="input-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $tag->slug }}" required>
            </div>
            @error('slug')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <div class="input-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" rows="5">{{ $tag->description }}</textarea>
            </div>
            @error('description')
            <div class="error">
                {{ $message }}
            </div>
            @enderror


            <div class="input-group">
                <label for="group">Группа</label>
                <input
                    @keyup="removeRadio"
                    type="text" name="group"
                    id="group"
                    value="{{ $tag->group }}">
            </div>
            @error('group')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <div class="input-group">
                <label for="group">Группа тегов</label>
                <div class="f-column">
                    @forelse( $groups as $group)
                        <div>
                            <input
                                @click="removeChecked"
                                @if( $group->group === $tag->group) checked @endif
                                type="radio" name="group" id="group_{{ $group->group }}" value="{{ $group->group }}">
                            <label for="group_{{ $group->group }}">{{ $group->group }}</label>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="input-group">
                <input type="submit" name="" id="" value="Обновить">
            </div>
        </form>
    </div>

@endsection
