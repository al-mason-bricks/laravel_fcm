<?php

namespace App\Traits;

use App\Models\UserFirebaseToken;

trait HasFirebaseTokens
{
    public function firebaseTokens()
    {
        return $this->hasMany(UserFirebaseToken::class);
    }
}
