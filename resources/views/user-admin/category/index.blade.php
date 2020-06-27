@extends('layouts.admin-layout')

@section('main')
    <div class="container">
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
                <th scope="col">Создана</th>
                <th scope="col">Обновлена</th>
                <th scope="col"></th>
                {{--TODO Delete should work--}}
                <th scope="col">Пока не удаляет</th>
            </tr>
            </thead>

            <tbody>
            @forelse( $categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>

                    <td>
                        <a href="{{ route('category.edit', $category) }}">Редактировать</a>
                    </td>

                    <td>
                        <form action="{{ route('category.destroy', $category) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <input type="submit" name="" id="" value="Удалить">
                        </form>
                    </td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>
    </div>
@endsection
