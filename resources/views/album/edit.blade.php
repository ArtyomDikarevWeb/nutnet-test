@extends('layouts.main')

@section('content')
    <div class="container__edit-form">
        <form class="edit-form" method="POST" action="{{route('albums.update', $album->id)}}" id="album-edit-form">
            @csrf
            @method('PUT')
            <fieldset class="edit-form__content">
                <legend class="edit-form__legend">Редактирование альбома</legend>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="edit-title" id="title-completer">Название</label>
                    <input
                        class="edit-form__input"
                        type="text"
                        name="title"
                        id="edit-title"
                        placeholder="Название"
                        value="{{ $album->title }}">
                    <p class="form-error-message display-none" id="title-error"></p>
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="edit-artist">Исполнитель</label>
                    <input
                        class="edit-form__input"
                        type="text"
                        name="artist"
                        id="edit-artist"
                        placeholder="Исполнитель"
                        value="{{ $album->artist }}"
                    >
                    <p class="form-error-message display-none" id="artist-error"></p>
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="edit-description">Описание</label>
                    <textarea
                        class="edit-form__textarea"
                        name="description"
                        id="edit-description"
                        placeholder="Описание"
                    >{{ $album->description }}</textarea>
                    <p class="form-error-message display-none" id="description-error"></p>
                    <div class="creation-form__description display-none" id="edit-autocomplete-description"></div>
                </div>
                <div class="edit-form__item">
                    <label class="edit-form__label" for="edit-cover_url">Обложка</label>
                    <input class="edit-form__input" type="text" name="cover_url" id="edit-cover_url" value="{{ $album->cover_url }}">
                    <p class="form-error-message display-none" id="cover_url-error"></p>
                    <div class="edit-form__cover">
                        <img class="edit-form__image" src="{{ $album->cover_url ?? 'https://fakeimg.pl/300x300/a43ba2/000' }}" alt="cover" id="edit-cover">
                    </div>
                </div>
                <div class="edit-form__item inline-style">
                    {{--
                        Пользователь может хотеть внести альбом, которого не будет на сайте last.fm
                        поэтому я посчитал, что имеет смысл добавить возомжность ему самому выбирать
                        хочет он, чтобы всё автозаполнялось или нет.

                        Также чекбокс позволяет определять, нужна ли валидация со стороны сервера
                    --}}
                    <label class="edit-form__label width-max-content margin-clear" for="edit-use_autocompletion">Использовать автодоплнение</label>
                    <input class="edit-form__checkbox" style="margin-left: 10px"  type="checkbox" name="use_autocompletion" id="edit-use_autocompletion">
                </div>
                <div class="edit-form__item">
                    <p class="edit-form__error-message display-none"></p>
                </div>
                <div class="edit-form__item align-center">
                    <button type="submit" class="edit-form__button" id="edit-form__button">Принять</button>
                </div>
            </fieldset>
        </form>
    </div>

    @pushonce('scripts')
        <script>
            const editCoverImg = document.getElementById('edit-cover');
            const editTitle = document.getElementById('edit-title');
            const editArtist = document.getElementById('edit-artist');
            const editUserDescription = document.getElementById('edit-description');
            const editAutocompleteDescription = document.getElementById('edit-autocomplete-description');
            const editCoverUrl = document.getElementById('edit-cover_url');
            const editUseAutocompletionFlag = document.getElementById('edit-use_autocompletion');
            const editCover = document.getElementById('edit-cover');
            const editTitleCompleter = document.getElementById('title-completer');
            const editCanvas = document.createElement("canvas");
            const editContext = editCanvas.getContext("2d");
            const editSearchAlbumLink = {!! json_encode(route('albums.search-album')) !!};
            const editGetAlbumInfoLink = {!! json_encode(route('albums.get-info')) !!};
            const editError = document.querySelector("p.creation-form__error-message");

            editCoverUrl.addEventListener('blur', function() {
                if (editCoverUrl.value === '') {
                    editCoverImg.src = 'https://fakeimg.pl/300x300/a43ba2/000';
                } else {
                    editCoverImg.src = editCoverUrl.value;
                }
            });

            editTitle.addEventListener('input', () => {
                let titleValue = editTitle.value;
                let titleValueWidth = Math.ceil(editContext.measureText(titleValue).width * 1.325);

                if (titleValue !== '' && editUseAutocompletionFlag.checked) {
                    searchAlbum(titleValue, titleValueWidth);
                }

                if (titleValue === '') {
                    editTitleCompleter.setAttribute('data-after', '');
                    setAutocompletionValues('', '', '', '');
                    editCover.setAttribute('hidden', '');
                }
            });

            editUseAutocompletionFlag.addEventListener('change', function() {
                if (this.checked) {
                    editCoverUrl.setAttribute('disabled', '');
                    editAutocompleteDescription.classList.remove('display-none');
                    editUserDescription.classList.add('display-none');
                    this.value = 1;
                    return true;
                }

                if (!this.checked) {
                    editCoverUrl.removeAttribute('disabled');
                    editTitleCompleter.setAttribute('data-after', '');
                    editAutocompleteDescription.classList.add('display-none');
                    editUserDescription.classList.remove('display-none');
                    this.value = 0;
                    return true;
                }
            })

            function setAutocompletionValues(albumName = '', responseArtist, description, responseCoverUrl = 'https://fakeimg.pl/300x300/a43ba2/000') {
                editTitle.value = albumName;
                editArtist.value = responseArtist;
                editCoverUrl.value = responseCoverUrl;
                editAutocompleteDescription.textContent = description;
                editCover.src = responseCoverUrl;
            }

            function searchAlbum(titleValue, titleValueWidth) {
                return fetch(`${editSearchAlbumLink}?title=${titleValue}`)
                    .then((response) => {
                        if (response.status === 422) {
                            return;
                        }

                        if (response.status === 400) {
                            return;
                        }

                        if (response.ok) {
                            response = response.json();

                            response.then((data) => {
                                let albumName = data.data.album.name;
                                let responseArtist = data.data.album.artist;
                                let completeText = albumName.slice(titleValue.length);
                                editTitleCompleter.style.setProperty('--title-completer-offset', `${titleValueWidth}px`);
                                editTitleCompleter.setAttribute('data-after', completeText)

                                if (albumName.toLowerCase() === titleValue.toLowerCase()) {
                                    getAlbumInfo(albumName, responseArtist);
                                }
                            });
                        }
                    })
            }

            function getAlbumInfo(title, artist) {
                fetch(`${editGetAlbumInfoLink}?title=${title}&artist=${artist}`)
                    .then((response) => response.json())
                    .then(data => {
                        console.log(data);
                        if (title.toLowerCase() === data.data.albumInfo.name.toLowerCase()) {
                            setAutocompletionValues(
                                data.data.albumInfo.name,
                                data.data.albumInfo.artist,
                                data.data.albumInfo.wiki.summary.replace(/\s<([^>]+?)([^>]*?)>(.*?)<\/\1>/ig, ''),
                                data.data.albumInfo.image[3]['#text'],
                            );
                            editCover.removeAttribute('hidden');
                        }
                    })
            }
        </script>
    @endpushonce
@endsection
