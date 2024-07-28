<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;

class User implements RoleInterface {

    // -------------------------------------------------------------------------------
    public function __construct() {
        
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