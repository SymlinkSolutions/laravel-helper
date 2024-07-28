<?php

namespace Symlink\LaravelHelper\Helpers\Roles\Intf;


interface RoleInterface {

    public function getLevel();
    public function getName();
    public function getCode();

}