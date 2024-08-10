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
    public $javascript = [];
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct() {
        $this->stylesheets = $this->linkedStyleSheets();
        $this->javascript = $this->linkedJs();
        $this->title = env("APP_NAME") . " | Dev Tools";
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        return view('symlink::developer.layout.dev');
    }
    // ----------------------------------------------------------------------------------------------------
    public function linkedJs() {
        return [
            "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js\" integrity=\"sha512-JyCZjCOZoyeQZSd5+YEAcFgz2fowJ1F1hyJOXgtKu4llIa0KneLcidn5bwfutiehUTiOuK87A986BZJMko0eWQ==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"></script>"
        ];
    }
    // ----------------------------------------------------------------------------------------------------
    public function linkedStyleSheets() {
        return [
            "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css\" integrity=\"sha512-UtLOu9C7NuThQhuXXrGwx9Jb/z9zPQJctuAgNUBK3Z6kkSYT9wJ+2+dh6klS+TDBCV9kNPBbAxbVD+vCcfGPaA==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" />"
        ];
    }
    // ----------------------------------------------------------------------------------------------------
}
