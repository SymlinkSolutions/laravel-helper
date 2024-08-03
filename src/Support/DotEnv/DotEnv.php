<?php

namespace Symlink\LaravelHelper\Support\DotEnv;

use Illuminate\Support\Arr;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Symlink\LaravelHelper\Services\ConfigIniService;

class DotEnv {
    // ---------------------------------------------------------------
    // Properties
    // ---------------------------------------------------------------
    protected $update_arr = [];
    // ---------------------------------------------------------------
    // functions
    // ---------------------------------------------------------------
    public function __construct() {
        
    }
    // ---------------------------------------------------------------
    public function update($key, $value){
        $current = env($key);
        if ($value == $current) return;

        $this->update_arr[$key] = $value;
    }
    // ---------------------------------------------------------------
    public function save(){
        if (empty($this->update_arr)) return;

        foreach ($this->update_arr as $key => $val){
            DotenvEditor::setKey($key, $val);
        }

        DotenvEditor::save();
    }
    // ---------------------------------------------------------------
}
