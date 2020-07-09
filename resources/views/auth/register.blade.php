@extends('layouts.layout')

@section('title', 'Страница регистрации на сайте блогера Ютубера Кукенон Qukenon')

@section('meta_keys', 'регистрация на сайте кукенон, регистрация чтобы написать комментарий или создать пост и свою
страничку')
@section('meta_description', 'Страница регистрации. После регистрации Вам будет доступна возможность комментировать
записи других людей, создавать свои страницы своих геймерских и не только проектов, а также создавать записи для
публикации и сбора фолловеров')

@section('canonical', url('/register'))

@section('main')
    <div class="container">
        <div class="">Регистрация</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <label for="name" class="">Имя</label>

                    <input id="name" type="text"
                           class="@error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="email"
                           class="">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email"
                           class="@error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password"
                           class="">{{ __('Password') }}</label>

                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="input-group">
                    <input type="submit" value="Зарегистрироваться">
                </div>
            </form>
        </div>
    </div>
@endsection
