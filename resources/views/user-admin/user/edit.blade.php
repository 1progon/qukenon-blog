@extends('layouts.admin-layout')



@section('main')
    <div class="container">
        <h2>Редактировать пользователя <span class="red">{{ $user->name }}</span>, id: {{ $user->id }}</h2>
        <form action="{{ route('users.update', $user) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="input-group">
                <label for="name" class="required">Имя</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>

            <div class="input-group">
                <label for="email" class="required">Email</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}" required>
            </div>

            <div class="input-group">
                <label></label>
                <a class="btn" v-on:click="changePassword = !changePassword" type="button">Изменить пароль</a>
            </div>

            @error('password')
            <div class="input-group">
                <label></label>
               <span class="red">{{ $message }}</span>
            </div>
            @enderror

            @error('password_confirmation')
            <div class="input-group">
                <label></label>
                <span class="red">{{ $message }}</span>
            </div>
            @enderror


            <div v-if="changePassword">
                <div class="input-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password">
                </div>


                <div class="input-group">
                    <label for="password2">Подтверждение пароля</label>
                    <input type="password" name="password_confirmation" id="password2">
                </div>


            </div>

            @if( $user)
                <div class="input-group">
                    <label for="active">Active</label>
                    <input type="checkbox" name="active" id="active" @if( $user->active ) checked @endif value="1">
                </div>
            @endif


            <div class="input-group">
                <input type="submit" value="Обновить">
            </div>


        </form>


    </div>


@endsection
