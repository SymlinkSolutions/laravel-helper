<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;

class Admin implements RoleInterface {

    // -------------------------------------------------------------------------------
    public function __construct() {
        
    }
    // -------------------------------------------------------------------------------
    public function getLevel() {
        return 100;        
    }
    // -------------------------------------------------------------------------------
    public function getName() {
        return "Admin";
    }
    // -------------------------------------------------------------------------------
    public function getCode() {
        return "gs1.role:ADMIN";
    }
    // -------------------------------------------------------------------------------

}