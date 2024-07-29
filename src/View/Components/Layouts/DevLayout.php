<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;

class DevLayout extends Component {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $title = "Somting Went wrong getting the page title!";
    public $theme = "light";
    public $stylesheets = [];
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        $this->stylesheets = $this->linkedStyleSheets();
        $this->title = env("APP_NAME") . " | Dev Tools";
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        return view('symlink::developer.layout.dev');
    }
    // ----------------------------------------------------------------------------------------------------
    public function linkedStyleSheets() {
        return [
        ];
    }
    // ----------------------------------------------------------------------------------------------------
}
