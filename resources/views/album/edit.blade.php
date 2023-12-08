@extends('layouts.main')

@section('content')
    <div class="container__edit-form">
        <form class="edit-form" method="POST" action="{{route('albums.update', $album->id)}}">
            @csrf
            @method('PUT')
            <fieldset class="edit-form__content">
                <legend class="edit-form__legend">Редактирование альбома</legend>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="title">Название</label>
                    <input
                        class="edit-form__input"
                        type="text" name="title"
                        id="title"
                        placeholder="Название"
                        value="{{ $album->title }}">
                    @error('title')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="artist">Исполнитель</label>
                    <input
                        class="edit-form__input"
                        type="text"
                        name="artist"
                        id="artist"
                        placeholder="Исполнитель"
                        value="{{ $album->artist }}"
                    >
                    @error('artist')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="description">Описание</label>
                    <textarea
                        class="edit-form__textarea"
                        name="description"
                        id="description"
                        placeholder="Описание"
                    >{{ $album->description }}</textarea>
                    @error('description')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="cover_url">Обложка</label>
                    <input class="edit-form__input" type="text" name="cover_url" id="cover_url" value="{{ $album->cover_url }}">
                    @error('cover_url')
                        <p class="form-error-message">{{ $message }}</p>
                    @enderror
                    <div class="edit-form__cover">
                        <img class="edit-form__image" src="{{ $album->cover_url ?? 'https://fakeimg.pl/300x300/a43ba2/000' }}" alt="cover" id="cover">
                    </div>
                </div>
                <div class="edit-form__item align-center">
                    <button type="submit" class="edit-form__button">Принять</button>
                </div>
            </fieldset>
        </form>
    </div>

    @pushonce('scripts')
        <script>
            const coverUrl = document.getElementById('cover_url');
            const coverImg = document.getElementById('cover');

            coverUrl.addEventListener('blur', function() {
                if (coverUrl.value === '') {
                    coverImg.src = 'https://fakeimg.pl/300x300/a43ba2/000';
                } else {
                    coverImg.src = coverUrl.value;
                }
            });
        </script>
    @endpushonce
@endsection
