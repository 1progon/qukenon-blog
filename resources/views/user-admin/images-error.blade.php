@extends('layouts.admin-layout')

@section('main')
    @php
        $files = Storage::allFiles();
        //$dirs = Storage::allDirectories();

    @endphp


    {{--Remove unused images--}}
    <form action="{{ route('error.images.remove') }}" method="post" id="remove-error-images">
        @csrf
        @method('DELETE')




        {{--Inside Table uses input fields with link on this form--}}


        <input type="submit" name="" id="" value="Удалить отмеченные">
    </form>

    <table class="tg">

        <thead>
        <tr>
            <th class="tg-h1c3">Id</th>
            <th class="tg-0iuq">Name</th>
            <th v-on:click="checkAll()" class="tg-0iuq">
                <label><input type="checkbox" name="" id=""></label>
            </th>
        </tr>
        </thead>
        <tbody>

        @forelse( $files as $key => $file)
            <tr>
                <td class="tg-d7ww">{{ $key }}</td>
                <td class="tg-88n5">{{ $file }}</td>
                <td class="tg-88n5">

                    <label>
                        <input class="images-to-remove"
                               type="checkbox"
                               name="images_to_remove[{{ $key }}]"
                               value="{{ $file }}"
                               form="remove-error-images">
                    </label>
                </td>

            </tr>

        @empty
        @endforelse


        </tbody>
    </table>








@endsection
