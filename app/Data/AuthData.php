<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AuthData extends Data
{
    public ?string $name = null;
    public string $password;
    public string $email;
}
