<?php

namespace App\Policies;

use App\User;
use App\Ad;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    public function adPolicy(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }
}
