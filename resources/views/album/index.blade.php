@extends('layouts.main')

@section('content')
    <div class="albums">
        @forelse($albums as $album)
            <div class="album">
                <div class="album__image-block">
                    <img src="{{  $album->cover_url }}" alt="Album image">
                </div>
                <div class="album__text-block">
                    <div>
                        <p>Название</p>
                        <p>{{ $album->title }}</p>
                    </div>
                    <div>
                        <p>Исполнитель</p>
                        <p>{{ $album->artist }}</p>
                    </div>
                    <div>
                        <div>
                            <p>Описание</p>
                            <p>{{ $album->description }}</p>
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
