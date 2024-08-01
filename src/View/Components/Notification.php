<?php

namespace Symlink\LaravelHelper\View\Components;

use Illuminate\View\Component;
use Symlink\LaravelHelper\Support\String\Str;

class Notification extends Component {
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $message;
    public $id;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($message = false) {
        $this->message = $message;
        $this->id = Str::generateCompoenentId();
    }
    // ----------------------------------------------------------------------------------------------------
    public function render() {
        $this->message = session('message');
        return view('symlink::components.notification');
    }
    // ----------------------------------------------------------------------------------------------------
}