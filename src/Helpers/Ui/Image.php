<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;

class Image implements FormInput {
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
    public function __construct($src = false, $options = []) {
        $this->options = array_merge([
            "width" => 250,
            "height" => 250,
            "alt" => "Image Alt",
            "src" => $src
        ], $options);

        $this->src = $this->get_src($src);

        $this->width = "{$this->options['width']}px";
        $this->height = "{$this->options['height']}px";
        $this->alt = $this->options['alt'];
    }
    // ----------------------------------------------------------------------------------------------------
    public function get_src($src) {
        if (!$src){
            return "https://via.placeholder.com/{$this->options['width']}";
        }

        return $src;
    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        return View::make('symlink::components.image', $this->options)->render();
    }
    // ----------------------------------------------------------------------------------------------------
}
