@extends('layouts.admin-layout')

@section('main')
    <div class="container">
        <h1>Все теги</h1>

        <label for="search-tag">Поиск тегов</label>
        <input @keyup.passive="getTagsOnSearch" type="text" name="" id="search-tag">

        <table id="tags-table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Название</th>
                <th>Открыть</th>
                <th scope="col">Редактировать</th>

                <th scope="col">Группа</th>

                <th scope="col">Создана</th>
                <th scope="col">Обновлена</th>

                <th scope="col">Постов с тегом</th>

                {{--TODO Delete should work--}}
                <th scope="col">Удалить</th>
            </tr>
            </thead>

            <tbody>
            @forelse( $tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>

                    <td>
                        <a target="_blank" href="{{ route('tag.show', $tag) }}">Открыть</a>
                    </td>

                    {{--Edit--}}
                    <td>
                        <a href="{{ route('tag.edit', $tag) }}">Редактировать</a>
                    </td>

                    <td>{{ $tag->group }}</td>

                    <td>{{ $tag->created_at }}</td>
                    <td>{{ $tag->updated_at }}</td>

                    <td>{{ $tag->posts->count() }}</td>


                    <td>
                        <form id="form-{{ $tag->id }}"
                              v-on:submit.prevent="showConfirmNotify"
                              action="{{ route('tag.destroy', $tag)}}"
                              method="post">

                            @csrf
                            @method('DELETE')

                            <div id="notify-{{ $tag->id }}" style="display: none" class="notify">

                                <p class="text-row">Точно удалить?? Посты останутся, но будут привязаны к дефолтной
                                    категории.. .Если ее нет, она будет создана</p>


                                <div class="action-buttons">
                                    <span v-on:click="removePostOrCategory({{ $tag->id }})" class="remove btn-outline">Удалить</span>

                                    <span v-on:click="hideConfirmNotify({{ $tag->id }})"
                                          class="decline btn">Отменить</span>
                                </div>

                                <div class="response-message">@{{ message }}</div>
                            </div>

                            <input class="link" type="submit" value="Удалить">
                        </form>

                    </td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>

        {{ $tags->links() }}

    </div>
@endsection
