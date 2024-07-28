<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class Submit implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    protected $options;
    // ----------------------------------------------------------------------------------------------------
    // Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($label, $options = []) {
        $this->options = array_merge([
            "label" => $label,
            "icon" => "bi bi-floppy",
            "classList" => "btn btn-primary w-100",
        ], $options);

    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        return View::make('symlink::components.input.submit', $this->options)->render();
    }
    // ----------------------------------------------------------------------------------------------------

}
