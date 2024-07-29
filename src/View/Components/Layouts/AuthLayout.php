<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;

class AuthLayout extends Component {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $title = "SOmting went wrong getting the app title!";
    public $theme = "light";
    public $stylesheets = [];
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        $this->stylesheets = $this->linkedStyleSheets();
        $this->title = env("APP_NAME");
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        return view('symlink::guest.layout.auth');
    }
    // ----------------------------------------------------------------------------------------------------
    public function linkedStyleSheets() {
        return [
            asset("fonts/bootstrap-icons/bootstrap-icons.css")
        ];
    }
    // ----------------------------------------------------------------------------------------------------
}
