@extends('layouts.layout')

@section('title', 'Контакты Ютубера Кукенон и как с ним связаться')

@section('meta_keys', 'контакты ютубера кукенон, как написать кукенону, где найти кукенона, как связаться с кукеноном')
@section('meta_description', 'Страница контактов, где можно и как связаться с Ютубером Кукенон, где написать и где
официальный сайт Ютубера Кукенон')

@section('canonical', url('/contact'))

@section('main')

    <div class="container">
        <div class="single-page">
            <h1>Контакты</h1>

            <div>
                <p>Привет - это Qukenon, для связи со мной отправь сообщение в форме ниже</p>

                <h2>Отправить сообщение</h2>
                <form action="/contact" method="post">
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input class="ym-disable-keys" type="text" name="email" id="email">
                    </div>

                    <div class="input-group">
                        <label for="name">Имя</label>
                        <input class="ym-disable-keys" type="text" name="name" id="name">
                    </div>

                    <div class="input-group">
                        <label for="message">Сообщение</label>
                        <textarea class="ym-disable-keys" name="message" id="message" rows="5"></textarea>
                    </div>

                    <div class="input-group">
                        <input class="ym-disable-keys" type="button" name="" id="" value="Отправить">
                    </div>




                </form>
            </div>
        </div>
    </div>


@endsection





