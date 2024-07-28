<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;

class AuthLayout extends Component {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $title = "Login";
    public $theme = "light";
    public $stylesheets = [];
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        $this->stylesheets = $this->linkedStyleSheets();
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
