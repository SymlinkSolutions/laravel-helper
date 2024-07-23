<?php

namespace Symlink\LaravelHelper\Observers;

use Symlink\LaravelHelper\Models\User;

class UserObserver {
    public function creating(User $user) : void {
        $user->name = "{$user->first_name} {$user->last_name}";
    }
}
