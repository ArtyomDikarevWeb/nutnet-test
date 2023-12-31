@extends('layouts.main')

@section('content')
    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
        <form class="register-form" method="POST" action="{{route('auth.register')}}">
            @csrf
            <fieldset class="register-form__fieldset">
                <legend class="register-form__legend">Регистрация</legend>
                <div class="register-form__element">
                    <div class="register-form__field-container">
                        <label class="register-form__label" for="email">Email:</label>
                        <input class="register-form__input" type="email" name="email" id="email" placeholder="Email">
                    </div>
                    @error('email')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="register-form__element">
                    <div class="register-form__field-container">
                        <label class="register-form__label" for="name">Имя:</label>
                        <input class="register-form__input" type="text" name="name" id="name" placeholder="Имя">
                    </div>
                    @error('name')
                    <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="register-form__element">
                    <div class="register-form__field-container">
                        <label class="register-form__label" for="password">Пароль:</label>
                        <input class="register-form__input" type="password" name="password" id="password" placeholder="Пароль">
                    </div>
                    @error('password')
                    <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="register-form__element">
                    <button class="register-form__button" type="submit">Зарегистрироваться</button>
                </div>
                <div class="register-form__element">
                    <p>Уже зарегистрированы?</p>
                    <a href="{{route('auth.login.form')}}">Войдите</a>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
