<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Data\AuthData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRegisterAction
{
    public function __invoke(AuthData $data): bool
    {
        try {
            DB::beginTransaction();
            User::query()->create([
                'email' => $data->email,
                'name' => $data->name,
                'password' => Hash::make($data->password),
            ]);

            DB::commit();

            Auth::attempt($data->all());

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
