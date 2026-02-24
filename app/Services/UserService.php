<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\InformAccountCreated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function informAccountCreated(User $user): void
    {
        $user->create_token = Hash::make(Str::random(64));
        $user->save();
        $user->notify(new InformAccountCreated($user));
    }
}
