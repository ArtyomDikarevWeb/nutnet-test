@extends('layouts.main')

@section('content')
    <div class="albums">
        @for($i = 0; $i <= 10; $i++)
            <div class="album">
                <div class="album__image-block">
                    <img src="#" alt="Album image">
                </div>
                <div class="album__text-block">
                    <div>
                        <p>Название</p>
                        <p>Альбом А</p>
                    </div>
                    <div>
                        <p>Исполнитель</p>
                        <p>Гучи Рэпер</p>
                    </div>
                    <div>
                        <div>
                            <p>Описание</p>
                            <p>
                                ASddasdasda ASddasdasda ASddasdasda ASddasdasda ASddasdasda ASddasdasda
                                ASddasdasdaASddasdasdaASddasdasdaASddasdasdaASddasdasdaASddasdasdaASddasdasda
                                ASddasdasda ASddasdasda ASddasdasda
                            </p>
                        </div>
                        <a class="album__link" href="#">Перейти</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
