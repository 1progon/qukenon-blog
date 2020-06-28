@extends('layouts.admin-layout')

@section('main')
    @php
        $files = Storage::allFiles();
        //$dirs = Storage::allDirectories();



    @endphp





    {{--<style type="text/css">--}}
    {{--    .tg {--}}
    {{--        border-collapse: collapse;--}}
    {{--        border-color: #ccc;--}}
    {{--        border-spacing: 0;--}}
    {{--        margin: 0px auto;--}}
    {{--    }--}}

    {{--    .tg td {--}}
    {{--        background-color: #fff;--}}
    {{--        border-color: #ccc;--}}
    {{--        border-style: solid;--}}
    {{--        border-width: 1px;--}}
    {{--        color: #333;--}}
    {{--        font-family: Arial, sans-serif;--}}
    {{--        font-size: 14px;--}}
    {{--        overflow: hidden;--}}
    {{--        padding: 10px 5px;--}}
    {{--        word-break: normal;--}}
    {{--    }--}}

    {{--    .tg th {--}}
    {{--        background-color: #f0f0f0;--}}
    {{--        border-color: #ccc;--}}
    {{--        border-style: solid;--}}
    {{--        border-width: 1px;--}}
    {{--        color: #333;--}}
    {{--        font-family: Arial, sans-serif;--}}
    {{--        font-size: 14px;--}}
    {{--        font-weight: normal;--}}
    {{--        overflow: hidden;--}}
    {{--        padding: 10px 5px;--}}
    {{--        word-break: normal;--}}
    {{--    }--}}

    {{--    .tg .tg-d7ww {--}}
    {{--        background-color: #f9f9f9;--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        font-style: italic;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}

    {{--    .tg .tg-h1c3 {--}}
    {{--        background-color: #fffe65;--}}
    {{--        color: #3531ff;--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        font-style: italic;--}}
    {{--        font-weight: bold;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}

    {{--    .tg .tg-0iuq {--}}
    {{--        background-color: #fffe65;--}}
    {{--        color: #3531ff;--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        font-weight: bold;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}

    {{--    .tg .tg-88n5 {--}}
    {{--        background-color: #f9f9f9;--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}

    {{--    .tg .tg-m9ox {--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        font-style: italic;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}

    {{--    .tg .tg-37em {--}}
    {{--        font-family: Tahoma, Geneva, sans-serif !important;;--}}
    {{--        font-size: 18px;--}}
    {{--        text-align: center;--}}
    {{--        vertical-align: middle--}}
    {{--    }--}}
    {{--</style>--}}
    <table class="tg">

        <thead>
        <tr>
            <th class="tg-h1c3">Id</th>
            <th class="tg-0iuq">Name</th>
            <th class="tg-0iuq">Remove</th>
            <th class="tg-0iuq"></th>
            <th class="tg-0iuq"></th>
        </tr>
        </thead>
        <tbody>

        @forelse( $files as $key => $file)


            <tr>
                <td class="tg-d7ww">{{ $key }}</td>
                <td class="tg-88n5">{{ $file }}</td>
                <td class="tg-88n5"><input type="checkbox" name="" id="" value="1"></td>
                <td class="tg-88n5"></td>
                <td class="tg-88n5"></td>
            </tr>

        @empty
        @endforelse

        </tbody>
    </table>



@endsection
