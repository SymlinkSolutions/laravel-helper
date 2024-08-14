<?php

namespace Symlink\LaravelHelper\Helpers\Roles\Access;

use Symlink\LaravelHelper\Helpers\Roles\Admin;
use Symlink\LaravelHelper\Helpers\Roles\Developer;

class admins {

    public function getRoles() {
        return [
            new Developer(),
            new Admin(),
        ];
    }

}
