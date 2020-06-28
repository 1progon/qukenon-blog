@extends('layouts.admin-layout')

@section('main')
    <div class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <h1>Все категории</h1>
        {{--        @forelse( $categories as $category)--}}
        {{--            <div class="text-row">--}}
        {{--                Название: {{ $category->title }} | Id: {{ $category->id }}--}}
        {{--                <a href="{{ route('category.edit', $category) }}">Редактировать</a>--}}
        {{--            </div>--}}
        {{--        @empty--}}
        {{--        @endforelse--}}

        <table>
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Название</th>
                <th scope="col">Редактировать</th>

                <th scope="col">Создана</th>
                <th scope="col">Обновлена</th>

                <th scope="col">В шапке</th>
                <th scope="col">Постов в кате</th>


                {{--TODO Delete should work--}}
                <th scope="col">Удалить</th>
            </tr>
            </thead>

            <tbody>
            @forelse( $categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>

                    {{--Edit--}}
                    <td>
                        <a href="{{ route('category.edit', $category) }}">Редактировать</a>
                    </td>

                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>

                    <td>{!! $category->main_bar ?  '<img width="16" src="/images/check.svg">'  : '' !!}</td>
                    <td>{{ $category->posts->count() }}</td>


                    <td>
                        <form id="form-{{ $category->id }}"
                              v-on:submit.prevent="showConfirmNotify($event)"
                              action="{{ route('category.destroy', $category)}}"
                              method="post">

                            @csrf
                            @method('DELETE')

                            <div id="notify-{{ $category->id }}" style="display: none" class="notify">

                                <p class="text-row">Точно удалить?? Посты останутся, но будут привязаны к дефолтной
                                    категории.. .Если ее нет, она будет создана</p>


                                <div class="action-buttons">
                                    <span v-on:click="removePostOrCategory({{ $category->id }})" class="remove btn-outline">Удалить</span>

                                    <span v-on:click="hideConfirmNotify({{ $category->id }})"
                                          class="decline btn">Отменить</span>
                                </div>

                                <div class="response-message">@{{ message }}</div>


                            </div>

                            <input class="link" type="submit" name="" id="" value="Удалить">
                        </form>

                    </td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
@endsection
