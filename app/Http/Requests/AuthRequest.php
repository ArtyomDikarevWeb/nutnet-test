<?php

namespace App\Http\Requests;

use App\Data\AuthData;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [
            'email' => ['email', 'required', 'min:3', 'max:255'],
            'password' => ['string', 'required', 'min:8', 'max:30'],
        ];

        if (request()->routeIs('auth.register')) {
            $rules['name'] = ['string', 'max:30'];
        }

        return $rules;
    }

    public function dto(): AuthData
    {
        return AuthData::from($this->validated());
    }
}
