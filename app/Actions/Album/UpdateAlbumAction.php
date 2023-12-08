<?php

declare(strict_types=1);

namespace App\Actions\Album;

use App\Data\AlbumData;
use App\Models\Album;

class UpdateAlbumAction
{
    public function __invoke(Album $album, AlbumData $data): Album
    {
        $album->fill($data->all());
        $album->save();

        return $album;
    }
}
