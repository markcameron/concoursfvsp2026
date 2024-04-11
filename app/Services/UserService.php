<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InformAccountCreated;

class UserService
{
    public function informAccountCreated(User $user): void
    {
        $user->create_token = Hash::make(Str::random(64));
        $user->save();
        $user->notify(new InformAccountCreated($user));
    }
}
