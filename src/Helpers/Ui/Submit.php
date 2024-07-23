<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;

class Submit implements FormInput {

    protected $options;

    public function __construct($label, $options = []) {
        $this->options = array_merge([
            "label" => $label,
            "icon" => "bi bi-floppy",
        ], $options);

        

    }

    public function build() {
        return View::make('symlink::components.input.submit', $this->options)->render();
    }

}
