@extends('layouts.main')

@section('content')
    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
        <form class="login-form" action="{{route('auth.login')}}">
            @method('POST')
            @csrf
            <fieldset class="login-form__fieldset">
                <legend class="login-form__legend">Вход</legend>
                <div class="login-form__element">
                    <label class="login-form__label" for="email">Email:</label>
                    <input class="login-form__input" type="email" name="email" id="email" placeholder="Email">
                </div>
                <div class="login-form__element">
                    <label class="login-form__label" for="password">Пароль:</label>
                    <input class="login-form__input" type="password" name="password" id="password" placeholder="Пароль">
                </div>
                <button class="login-form__button" type="submit">Войти</button>
                <div class="login-form__element">
                    <p>Ещё не зарегистрированы?</p>
                    <a href="{{route('auth.register.form')}}">Зарегистрируйтесь</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
