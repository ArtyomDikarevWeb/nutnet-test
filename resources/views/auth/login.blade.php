@extends('layouts.main')

@section('content')
    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
        <form class="login-form" method="POST" action="{{route('auth.login')}}">
            <fieldset class="login-form__fieldset">
                @csrf
                <legend class="login-form__legend">Вход</legend>
                <div class="login-form__element">
                    <div class="login-form__field-container">
                        <label class="login-form__label" for="email">Email:</label>
                        <input class="login-form__input" type="email" name="email" id="email" placeholder="Email">
                    </div>
                    @error('email')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="login-form__element">
                    <div class="login-form__field-container">
                        <label class="login-form__label" for="password">Пароль:</label>
                        <input class="login-form__input" type="password" name="password" id="password" placeholder="Пароль">
                    </div>
                    @error('password')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="login-form__element">
                    <button class="login-form__button" type="submit">Войти</button>
                </div>
                <div class="login-form__element">
                    <p>Ещё не зарегистрированы?</p>
                    <a href="{{route('auth.register.form')}}">Зарегистрируйтесь</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
