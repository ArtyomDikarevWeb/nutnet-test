<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\AlbumData;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateAlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'artist' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:10000'],
            'cover_url' => ['required', 'string', 'min:1', 'max:1000'],
            'use_autocompletion' => ['required', 'boolean']
        ];
    }

    public function attributes(): array
    {
        return [
            'title ' => __('messages.album.validation.title'),
            'artist' => __('messages.album.validation.artist'),
            'description' => __('messages.album.validation.description'),
            'cover_url' => __('messages.album.validation.cover_url'),
            'use_autocompletion' => __('messages.album.validation.use_autocompletion')
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(
          response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    public function dto(): AlbumData
    {
        return AlbumData::from($this->validated());
    }
}
