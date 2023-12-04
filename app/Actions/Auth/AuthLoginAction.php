<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Data\AuthData;
use App\Exceptions\Auth\EmailException;
use App\Exceptions\Auth\PasswordException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthLoginAction
{
    /**
     * @throws \Exception
     */
    public function __invoke(AuthData $data): bool
    {
        $data = $data->only('email', 'password');
        $user = User::query()
            ->where('email', $data->email)
            ->firstOr(fn () => throw new EmailException(__('messages.user.login.email_does_not_exist')));

        if (!Hash::check($data->password, $user->password)) {
            throw new PasswordException(__('messages.user.login.incorrect_password'));
        }

        if (Auth::attempt($data->all())) {
            return true;
        };

        return false;
    }
}
