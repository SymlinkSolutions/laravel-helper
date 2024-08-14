<?php

namespace Symlink\LaravelHelper\Helpers\Roles\Access;

use Symlink\LaravelHelper\Helpers\Roles\Admin;
use Symlink\LaravelHelper\Helpers\Roles\Developer;
use Symlink\LaravelHelper\Helpers\Roles\User;

class users {

    public function getRoles() {
        return [
            new Developer(),
            new User(),
            new Admin(),
        ];
    }

}
