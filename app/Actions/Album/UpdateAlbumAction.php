<?php

declare(strict_types=1);

namespace App\Actions\Album;

use App\Data\AlbumData;
use App\Models\Album;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateAlbumAction
{
    public function __invoke(Album $album, AlbumData $data, User $user): Album
    {
        $albumBeforeUpdate = $album->replicate();
        $album->fill($data->all());
        $album->save();

        $dateTime = Carbon::now()->format('d-m-Y-H-i-s');

        Log::channel('album_update')->info("Album was updated at {$dateTime}.", [
            'by' => $user,
            'albumBeforeUpdate' => $albumBeforeUpdate,
            'albumAfterUpdate' => $album
        ]);
        return $album;
    }
}
