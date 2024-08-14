<?php

namespace Symlink\LaravelHelper\Helpers\Roles\Access;

use Symlink\LaravelHelper\Helpers\Roles\Admin;
use Symlink\LaravelHelper\Helpers\Roles\Developer;

class developers {

    public function getRoles() {
        return [
            new Developer(),
        ];
    }

}
