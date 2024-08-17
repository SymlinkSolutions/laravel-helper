<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;
use Symlink\LaravelHelper\Support\String\Str;

class Popup implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $src;
    public $width;
    public $height;
    public $alt;
    public $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($route, $options = []) {
        $this->options = array_merge([
            "route" => $route
        ], $options);

    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        $this->options['src'] = $this->src; // Ensure the src is passed to the view

        return View::make('symlink::components.popup', $this->options)->render();
    }
    // ----------------------------------------------------------------------------------------------------
}
