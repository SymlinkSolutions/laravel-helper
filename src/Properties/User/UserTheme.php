<?php

namespace Symlink\LaravelHelper\Properties\User;

use Symlink\LaravelHelper\Properties\property;

class UserTheme extends Property {

    /**
     * @var App\Models\User
     */
    protected $model = false;

    public function key() {
        return "gs1.user:Theme";
    }

    public function default() {
        return "light";
    }

    public function get_data_arr(){
        return [
            "light" => "Light",
            "dark" => "Dark",
        ];
    }

}