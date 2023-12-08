<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Data\AlbumData;

interface MusicLibraryInterface {
    public function searchAlbum(string $albumTitle);
    public function getAlbumInfo(string $albumTitle, string $artistName);
    public function checkIfUserDataCorrect(AlbumData $data);
    public function searchArtist(string $artist);
}
