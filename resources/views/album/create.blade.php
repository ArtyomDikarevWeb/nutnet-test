@extends('layouts.main')

@section('content')
    <div class="container__creation-form">
        <form class="creation-form" method="POST" action="{{route('albums.store')}}">
            @csrf
            <fieldset class="creation-form__content">
                <legend class="creation-form__legend">Создание альбома</legend>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="title">Название</label>
                    <input class="creation-form__input" type="text" name="title" id="title" placeholder="Название">
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="artist">Исполнитель</label>
                    <input class="creation-form__input" type="text" name="artist" id="artist" placeholder="Исполнитель">
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="description">Описание</label>
                    <textarea
                        class="creation-form__textarea"
                        name="description"
                        id="description"
                        placeholder="Описание"
                    ></textarea>
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="cover">Обложка</label>
                    <input class="creation-form__file" type="file" name="cover" id="cover">
                </div>
                <div class="creation-form__item flex align-center">
                    <button type="submit" class="creation-form__button">Создать</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
