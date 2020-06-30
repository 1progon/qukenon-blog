@extends('layouts.layout')

@section('main')
    <div class="login-form">
        <div class="container">
            <div class="">Вход</div>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" placeholder="e-mail">
                    @error('email')
                    <div class='form-error-message'>{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="password">
                </div>


                <div class="input-group">
                    <input type="submit" name="" id="" value="Войти">
                </div>
            </form>
        </div>
    </div>
@endsection
