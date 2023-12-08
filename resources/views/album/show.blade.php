@extends('layouts.main')

@section('content')
    <div class="container__show-album">
        <div class="show-album">
            <div class="show-album__content">
                <h3 class="show-album__title">{{ $album->title }}</h3>
                <div class="creation-form__item">
                    <img src="#" alt="Обложка">
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
                <div class="creation-form__item flex align-center">
                    <button type="submit" class="creation-form__button">Создать</button>
                </div>
            </div>
        </div>
    </div>
@endsection
