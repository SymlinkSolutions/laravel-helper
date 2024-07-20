<?php

namespace Symlink\LaravelHelper\View\Components;

use Illuminate\View\Component;

class Notification extends Component {
    public $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function render() {
        return view('symlink::components.notification');
    }
}