@extends('layouts.main')

@section('content')
    <div class="container__edit-form">
        <form class="edit-form" method="POST" action="{{route('albums.update')}}">
            @csrf
            @method('PUT')
            <fieldset class="edit-form__content">
                <legend class="edit-form__legend">Редактирование альбома</legend>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="title">Название</label>
                    <input class="edit-form__input" type="text" name="title" id="title" placeholder="Название">
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="artist">Исполнитель</label>
                    <input class="edit-form__input" type="text" name="artist" id="artist" placeholder="Исполнитель">
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="description">Описание</label>
                    <textarea
                        class="edit-form__textarea"
                        name="description"
                        id="description"
                        placeholder="Описание"
                    ></textarea>
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="cover">Обложка</label>
                    <input class="creation-form__file" type="file" name="cover" id="cover">
                </div>
                <div class="edit-form__item align-center">
                    <button type="submit" class="edit-form__button">Создать</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
