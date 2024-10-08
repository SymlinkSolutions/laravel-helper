<?php

namespace Symlink\LaravelHelper\View\Components\Layouts;

use Illuminate\View\Component;
use Symlink\LaravelHelper\Services\ConfigIniService;

class GuestLayout extends Component {
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
        $this->title = env("APP_NAME");
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        return view('symlink::guest.layout.guest');
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
