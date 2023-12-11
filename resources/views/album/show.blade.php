@extends('layouts.main')

@section('content')
    <div class="container__show-album">
        <div class="show-album">
            <div class="show-album__content">
                <h3 class="show-album__title">{{ $album->title }}</h3>
                <div class="show-album__item flex justify-center">
                    <div class="show-album__image-container">
                        <img class="show-album__image" src="{{ $album->cover_url }}" alt="Обложка">
                    </div>

                </div>
                <div class="show-album__item">
                    <p class="show-album__subject">Исполнитель</p>
                    <p class="show-album__data">{{ $album->artist }}</p>
                </div>
                <div class="show-album__item">
                    <p class="show-album__subject">Описание</p>
                    <p class="show-album__data">{{ $album->description }}</p>
                </div>
                <div class="show-album__item text-right">
                    <a href="{{ route('albums.edit', $album->id) }}" class="show-album__button">Редактировать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
