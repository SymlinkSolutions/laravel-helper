<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;
use Symlink\LaravelHelper\Services\ConfigIniService;

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
        $ini = new ConfigIniService();
        return [
            $ini->get('font_primary'),
        ];
    }
    // ----------------------------------------------------------------------------------------------------
}
