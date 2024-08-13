<?php

namespace Symlink\LaravelHelper\Helpers\Roles\Traits;

use App\Models\Roles as ModelsRole;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

trait Role {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $obj = false;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function RoleConstruct() {
        $this->obj = $this->getDatabaseObj();
    }
    // ----------------------------------------------------------------------------------------------------
    public function getDatabaseObj(){
        return ModelsRole::where("code", $this->getCode())->first();
    }
    // ----------------------------------------------------------------------------------------------------
    public function getObj() {
        return $this->obj;
    }
    // ----------------------------------------------------------------------------------------------------
}
