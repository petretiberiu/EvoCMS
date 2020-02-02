<?php

namespace App\Observers;

use App\Models\User;

class UserObserver {
    public function saving(User $user) {
        $user->Password = password_hash($user->Password, CRYPT_SHA256);
        $user->auth_token = bin2hex(openssl_random_pseudo_bytes(30));
    }
}
