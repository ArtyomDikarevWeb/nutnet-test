<?php

namespace App\Exceptions\MusicLibrary;

use Exception;
use Illuminate\Http\JsonResponse;

class MusicLibraryException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(['errors' => ['message' => $this->getMessage()]], 400);
    }
}
