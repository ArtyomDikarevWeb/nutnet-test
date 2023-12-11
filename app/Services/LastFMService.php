<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\AlbumData;
use App\Exceptions\MusicLibrary\MusicLibraryException;
use App\Services\Interfaces\MusicLibraryInterface;
use Illuminate\Support\Facades\Http;

class LastFMService implements MusicLibraryInterface
{
    /**
     * @throws MusicLibraryException
     */
    public function searchAlbum(string $albumTitle): array
    {
        $response = Http::get("https://ws.audioscrobbler.com/2.0/?method=album.search&album={$albumTitle}&limit=1&api_key={$this->getApiKey()}&format=json");
        $album = $response->json();

        if (empty($album['results']['albummatches']['album'])) {
            throw new MusicLibraryException('messages.music_library_service.errors.album_name_does_not_exist');
        }

        return $album['results']['albummatches']['album'][0];
    }

    /**
     * @throws MusicLibraryException
     */
    public function searchArtist(string $artist): array
    {
        $response = Http::get("https://ws.audioscrobbler.com/2.0/?method=artist.search&artist={$artist}&limit=1&api_key={$this->getApiKey()}&format=json");
        $artistResponse = $response->json();

        return $artistResponse['results']['artistmatches']['artist'][0];
    }

    /**
     * @throws MusicLibraryException
     */
    public function getAlbumInfo(string $albumTitle, string $artistName): array
    {
        $album = $this->searchAlbum($albumTitle);
        $artist = $this->searchArtist($artistName);
        $response = Http::get("https://ws.audioscrobbler.com/2.0/?method=album.getinfo&album={$album['name']}&artist={$artist['name']}&limit=1&api_key={$this->getApiKey()}&format=json");
        $response = $response->json();

        if (empty($response['album']['mbid'])) {
            throw new MusicLibraryException(__('messages.music_library_service.errors.combination_does_not_exist'));
        }

        return $response['album'];
    }

    /**
     * @throws MusicLibraryException
     */
    public function checkIfUserDataCorrect(AlbumData $data): array
    {
        $albumInfo = $this->getAlbumInfo(trim($data->title), trim($data->artist));

        if (mb_strtolower($data->title) !== mb_strtolower($albumInfo['name'])) {
            throw new MusicLibraryException(__('messages.music_library_service.errors.album_name_does_not_exist'));
        }

        if (mb_strtolower($data->artist) !== mb_strtolower($albumInfo['artist'])) {
            throw new MusicLibraryException(__('messages.music_library_service.errors.artist_does_not_exist'));
        }

        if (trim($albumInfo['image'][3]['#text']) !== trim($data->cover_url)) {
            throw new MusicLibraryException(__('messages.music_library_service.errors.cover_url_does_not_match'));
        }

        return $albumInfo;
    }

    private function getApiKey(): string
    {
        return env('LAST_FM_API_KEY', '');
    }
}
