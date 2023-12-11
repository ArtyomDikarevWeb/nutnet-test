@extends('layouts.main')

@section('content')
    <div class="create-button__block">
        <a href="{{ route('albums.create') }}" class="create-button">Создать Альбом</a>
    </div>
    <div class="albums">
        @forelse($albums as $album)
            <div class="album">
                <div class="album__image-block">
                    <img class="album__image" src="{{ $album->cover_url }}" alt="Album image">
                </div>
                <div class="album__text-block">
                    <div class="text-block__item">
                        <p class="text-block__title">Название</p>
                        <p class="text-block__value">{{ $album->title }}</p>
                    </div>
                    <div class="text-block__item">
                        <p class="text-block__title">Исполнитель</p>
                        <p class="text-block__value">{{ $album->artist }}</p>
                    </div>
                    <div class="text-block__item">
                        <div class="link-separator">
                            <p class="text-block__title">Описание</p>
                            <p class="text-block__value text-block__description">{{ $album->description }}</p>
                        </div>
                        <a class="album__link" href="{{route('albums.show', $album->id)}}">Перейти</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="albums__empty">
                <p>В данный момент альбомов в справочнике нет. Станьте первым кто создаст альбом ;)</p>
            </div>
        @endforelse
            <x-pagination-component :paginator="$albums"/>
    </div>
@endsection
