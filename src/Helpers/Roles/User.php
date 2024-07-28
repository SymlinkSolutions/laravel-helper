<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;
use Symlink\LaravelHelper\Helpers\Roles\Traits\Role;

class User implements RoleInterface {
    use Role;
    // -------------------------------------------------------------------------------
    public function __construct() {
        $this->RoleConstruct();
    }
    // -------------------------------------------------------------------------------
    public function getLevel() {
        return 10;        
    }
    // -------------------------------------------------------------------------------
    public function getName() {
        return "User";
    }
    // -------------------------------------------------------------------------------
    public function getCode() {
        return "gs1.role:USER";
    }
    // -------------------------------------------------------------------------------

}