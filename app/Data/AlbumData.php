<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AlbumData extends Data
{
    public string $title;
    public string $artist;
    public string $description;
    public string $cover_url;
    public ?bool $use_autocompletion;
}
