<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;

class Developer implements RoleInterface {

    // -------------------------------------------------------------------------------
    public function __construct() {
        
    }
    // -------------------------------------------------------------------------------
    public function getLevel() {
        return 10000;        
    }
    // -------------------------------------------------------------------------------
    public function getName() {
        return "Developer";
    }
    // -------------------------------------------------------------------------------
    public function getCode() {
        return "gs1.role:DEVELOPER";
    }
    // -------------------------------------------------------------------------------

}