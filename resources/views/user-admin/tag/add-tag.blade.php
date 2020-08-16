@extends('layouts.admin-layout')


@section('main')
    <div class="container">

        <h2>Создать тег</h2>


        <form action="{{ route('tag.store') }}" method="post">
            @csrf

            <div class="input-group">
                <label for="name" class="required">Название</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       required>
            </div>

            @error('name')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <div class="input-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug"
                       id="slug"
                       placeholder="если не вводить, будет создан на основе названия"
                       value="{{ old('slug') }}">
            </div>
            @error('slug')
            <div class="error">
                {{ $message }}
            </div>
            @enderror

            <div class="input-group">
                <label for="description">Описание</label>
                <textarea name="description" id="description" rows="5">{{ old('description') }}</textarea>
            </div>


            <div class="input-group">
                <label for="group">Новая Группа</label>
                <input
                    @keyup="removeRadio"
                    type="text" name="group"
                    id="group"
                    placeholder="Если вводить, то не должно быть выбрано ни одной из списка"
                    value="{{ old('group') }}">
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
                            <input @click="removeChecked"
                                   @if($group->group === 'default') checked @endif
                                   type="radio"
                                   name="group"
                                   id="group_{{ $group->group }}"
                                   value="{{ $group->group }}">
                            <label for="group_{{ $group->group }}">{{ $group->group }}</label>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>


            <div class="input-group">
                <input type="submit" name="" id="" value="Добавить">
            </div>
        </form>
    </div>

@endsection
