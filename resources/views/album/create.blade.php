@extends('layouts.main')

@section('content')
    <div class="container__creation-form">
        <form class="creation-form" action="{{route('albums.store')}}" id="album-creation-form">
            @csrf
            <fieldset class="creation-form__content">
                <legend class="creation-form__legend">Создание альбома</legend>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="title" id="title-completer">Название</label>
                    <input class="creation-form__input" type="text" name="title" id="title" placeholder="Название">
                    <p class="form-error-message display-none" id="title-error"></p>
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="artist">Исполнитель</label>
                    <input class="creation-form__input" type="text" name="artist" id="artist" placeholder="Исполнитель">
                    <p class="form-error-message display-none" id="artist-error"></p>
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="description">Описание</label>
                    <textarea
                        class="creation-form__textarea"
                        name="description"
                        id="description"
                        placeholder="Описание"
                    ></textarea>
                    <p class="form-error-message display-none" id="description-error"></p>
                    <div class="creation-form__description display-none" id="autocomplete-description"></div>
                </div>
                <div class="creation-form__item">
                    <label class="creation-form__label" for="cover_url">Обложка</label>
                    <input class="creation-form__input" type="text" name="cover_url" id="cover_url" placeholder="Введите ссылку на изображение">
                    <p class="form-error-message display-none" id="cover_url-error"></p>
                    <div class="creation-form__cover">
                        <img class="creation-form__cover" hidden src="https://fakeimg.pl/300x300/a43ba2/000" alt="cover" id="cover">
                    </div>
                </div>
                <div class="creation-form__item inline-style">
                    {{--
                        Пользователь может хотеть внести альбом, которого не будет на сайте last.fm
                        поэтому я посчитал, что имеет смысл добавить возомжность ему самому выбирать
                        хочет он, чтобы всё автозаполнялось или нет.

                        Также чекбокс позволяет определять, нужна ли валидация со стороны сервера
                    --}}
                    <label class="creation-form__label width-max-content margin-clear" for="use_autocompletion">Использовать автодоплнение</label>
                    <input class="creation-form__checkbox" type="checkbox" name="use_autocompletion" id="use_autocompletion">
                </div>
                <div class="creation-form__item">
                    <p class="creation-form__error-message display-none"></p>
                </div>
                <div class="creation-form__item flex align-center">
                    <button type="submit" class="creation-form__button" id="creation-form__button">Создать</button>
                </div>
            </fieldset>
        </form>
    </div>

    @push('scripts')
        <script type="text/javascript">
            const title = document.getElementById('title');
            const artist = document.getElementById('artist');
            const userDescription = document.getElementById('description');
            const autocompleteDescription = document.getElementById('autocomplete-description')
            const coverUrl = document.getElementById('cover_url');
            const cover = document.getElementById('cover');
            const titleCompleter = document.getElementById('title-completer');
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            const useAutocompletionFlag = document.getElementById('use_autocompletion');
            const apiKey = {!! json_encode($last_fm_api_key) !!};

            title.addEventListener('input', () => {
                let titleValue = title.value;
                let titleValueWidth = Math.ceil(context.measureText(titleValue).width * 1.325);

                if (titleValue !== '' && useAutocompletionFlag.checked) {
                    searchAlbum(titleValue, titleValueWidth);
                }


                if (titleValue === '') {
                    titleCompleter.setAttribute('data-after', '');
                    setAutocompletionValues('', '', '', '');
                    cover.setAttribute('hidden', '');
                }


            });

            useAutocompletionFlag.addEventListener('change', function() {
                if (this.checked) {
                    coverUrl.setAttribute('hidden', '');
                    cover.removeAttribute('hidden');
                    autocompleteDescription.classList.remove('display-none');
                    userDescription.classList.add('display-none');
                    this.value = 1;
                    return true;
                }

                if (!this.checked) {
                    coverUrl.removeAttribute('hidden');
                    cover.setAttribute('hidden', '');
                    titleCompleter.setAttribute('data-after', '');
                    autocompleteDescription.classList.add('display-none');
                    userDescription.classList.remove('display-none');
                    this.value = 0;
                    return true;
                }
            })

            function setAutocompletionValues(albumName = '', responseArtist, description, responseCoverUrl) {
                title.value = albumName;
                artist.value = responseArtist;
                coverUrl.value = responseCoverUrl;
                autocompleteDescription.innerHTML = description;
                cover.src = responseCoverUrl === '' ? 'https://fakeimg.pl/300x300/a43ba2/000' : responseCoverUrl;
            }

            function searchAlbum(titleValue, titleValueWidth) {
                return fetch(`https://ws.audioscrobbler.com/2.0/?method=album.search&album=${titleValue}&limit=1&api_key=${apiKey}&format=json`)
                    .then((response) => {
                        return response.json();
                    })
                    .then(data => {
                        let albumName = data.results.albummatches.album[0].name;
                        let responseArtist = data.results.albummatches.album[0].artist;
                        let completeText = albumName.slice(titleValue.length);
                        titleCompleter.style.setProperty('--title-completer-offset', `${titleValueWidth}px`);
                        titleCompleter.setAttribute('data-after', completeText)

                        if (albumName.toLowerCase() === titleValue.toLowerCase()) {
                            getAlbumInfo(albumName, responseArtist);
                        }
                    });
            }

            function getAlbumInfo(title, artist) {
                fetch(`https://ws.audioscrobbler.com/2.0/?method=album.getinfo&album=${title}&artist=${artist}&limit=1&api_key=${apiKey}&format=json`)
                    .then((response) => response.json())
                    .then(data => {
                        if (title.toLowerCase() === data.album.name.toLowerCase()) {
                            setAutocompletionValues(
                                data.album.name,
                                data.album.artist,
                                data.album.wiki.summary.replace(/\s<([^>]+?)([^>]*?)>(.*?)<\/\1>/ig, ''),
                                data.album.image[3]['#text'],
                            );
                            cover.removeAttribute('hidden');
                        }
                    })
            }
        </script>
    @endpush
@endsection
