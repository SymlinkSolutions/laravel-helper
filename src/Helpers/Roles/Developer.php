<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;
use Symlink\LaravelHelper\Helpers\Roles\Traits\Role;

class Developer implements RoleInterface {
    use Role;
    // -------------------------------------------------------------------------------
    public function __construct() {
        $this->RoleConstruct();
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