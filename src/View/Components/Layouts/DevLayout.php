<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;

class DevLayout extends Component {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $title = "Somting Went wrong getting the page title!";
    public $theme = "light";
    public $stylesheets = [
        "https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css",
    ];
    public $javascript = [
        "https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js",
        "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js",
    ];
    public $vite_sass = [
        'resources/sass/system.scss',
    ];
    public $vite_javascript = [
        // 'vendor/components/jquery/jquery.js',
        'vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js',
        'resources/js/system.js',
    ];

    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        $this->title = env("APP_NAME") . " | Dev Tools";
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        return view('symlink::developer.layout.dev');
    }
    // ----------------------------------------------------------------------------------------------------
    public function add_script($script) {
        $this->javascript[] = $script;
    }
    // ----------------------------------------------------------------------------------------------------
    public function linkedStyleSheets($css) {
        $this->stylesheets = $css;
    }
    // ----------------------------------------------------------------------------------------------------
}
