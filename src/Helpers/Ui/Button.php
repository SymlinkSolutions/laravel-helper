<?php

namespace Symlink\LaravelHelper\Helpers\Ui;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Symlink\LaravelHelper\Helpers\Ui\Intf\FormInput;
use Symlink\LaravelHelper\Helpers\Ui\Traits\Component;

class Button implements FormInput {
    // ----------------------------------------------------------------------------------------------------
    use Component;
    // ----------------------------------------------------------------------------------------------------
    //  Properties
    // ----------------------------------------------------------------------------------------------------
    public $options;
    // ----------------------------------------------------------------------------------------------------
    //  Functions
    // ----------------------------------------------------------------------------------------------------
    public function __construct($label, $href = "#", $options = []) {
        $this->options = array_merge([
            "label" => $label,
            "onclick" => false,
            "href" => $href,
            "classList" => false,
        ], $options);

        $this->options['classList'] = $this->extract_classlist();

    }
    // ----------------------------------------------------------------------------------------------------
    public function build() {
        return $this->view("symlink::components.button");
    }
    // ----------------------------------------------------------------------------------------------------
}
