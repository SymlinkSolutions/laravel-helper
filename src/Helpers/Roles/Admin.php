<?php

namespace Symlink\LaravelHelper\Helpers\Roles;

use Symlink\LaravelHelper\Helpers\Roles\Intf\RoleInterface;
use Symlink\LaravelHelper\Helpers\Roles\Traits\Role;

class Admin implements RoleInterface {
    use Role;
    // -------------------------------------------------------------------------------
    public function __construct() {
        $this->RoleConstruct();
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