<?php

declare(strict_types=1);

namespace App\Actions\Album;

use App\Data\AlbumData;
use App\Models\Album;
use App\Services\Interfaces\MusicLibraryInterface;

class StoreAlbumAction
{
    public function __construct(readonly private MusicLibraryInterface $service)
    {}

    public function __invoke(AlbumData $data): bool
    {
        if (!$data->use_autocompletion) {
            $album = Album::create($data->all());

            return (bool)$album;
        }

        $response = $this->service->checkIfUserDataCorrect($data);
        $description = preg_replace('/\s<([^>]+?)([^>]*?)>(.*?)<\/\1>/i', '', $response['wiki']['summary']);

        $album = Album::create([
            'artist' => $response['artist'],
            'title' => $response['name'],
            'cover_url' => $response['image'][3],
            'description' => $description
        ]);

        return (bool)$album;
    }
}
